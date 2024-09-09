<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Card;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PendingTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class ClientController extends Controller
{

    public function index()
    {
        function insertAfterKey(array $array, string $target_key, string $new_key, $new_value): array
        {
            $new_array = [];
            foreach ($array as $key => $value) {
                $new_array[$key] = $value;
                if ($key === $target_key) {
                    $new_array[$new_key] = $new_value;
                }
            }
            return $new_array;
        }

        $data['columns'] = [
            'id' => [],
            'agency_id' => [],
            'card_id' => [],
            'card_serial' => [],
            'creator_admin_id' => [],
            'creator_staff_id' => [],
            'created_at' => [],

            'first_name' => ['text' => 'Prénom', 'th_class' => ''],
            'last_name' => ['text' => 'Nom', 'th_class' => ''],
            'cin' => ['text' => 'cin', 'th_class' => ''],
            'phone_number' => ['text' => 'N.téléphone', 'th_class' => ''],
            'gender' => ['text' => 'Sexe', 'th_class' => ''],
            'optional_name' => ['text' => 'nom facultatif', 'th_class' => ''],
            'wallet' => ['text' => 'portefeuille', 'th_class' => ''],
            'expiry_date' => ['text' => 'date expiration', 'th_class' => ''],
            'status' => ['text' => 'statut', 'th_class' => ''],
            'creator' => ['text' => 'créateur', 'th_class' => ''],
        ];


        if (Auth::guard('admin')->check()) {
            $data['rows'] = Client::select(array_keys($data['columns']))
                ->leftJoin('cards', 'clients.card_id', '=', 'cards.id')
                ->leftJoin('agencies', 'clients.agency_id', '=', 'agencies.id')
                ->select('clients.*', 'cards.name as card_name', 'agencies.name as agency_name')
                ->orderBy('clients.updated_at', 'desc')
                ->get();

            // Helper function to get creator names
            $getCreatorName = function ($modelClass, $id) {
                return $modelClass::where('id', $id)
                    ->select(DB::raw("CONCAT_WS(' ', first_name, last_name) as name"))
                    ->value('name');
            };

            // Process rows to add creator names
            foreach ($data['rows'] as $row) {
                $row['creator_admin_id'] = $getCreatorName(Admin::class, $row['creator_admin_id']);
                $row['creator_staff_id'] = $getCreatorName(Staff::class, $row['creator_staff_id']);

                $row['creator'] = $row['creator_admin_id']
                    ? ($row['creator_staff_id'] ? "{$row['creator']}.{$row['creator_admin_id']}" : $row['creator_admin_id'])
                    : ($row['creator_staff_id'] ? "{$row['creator']}.{$row['creator_staff_id']}" : '-');

                $row['agency_id'] = $row['agency_id'] ?: '-';
                $row['card_id'] = $row['card_id'] ?: '-';
            }

            // Insert card_name and agency_name columns after 'gender'
            $data['columns'] = insertAfterKey($data['columns'], 'gender', 'card_name', ['text' => 'card', 'th_class' => '']);
            $data['columns'] = insertAfterKey($data['columns'], 'gender', 'agency_name', ['text' => 'agence', 'th_class' => '']);

        } elseif (Auth::guard('staff')->check()) {
            unset(
                $data['columns']['agency_id'],
                $data['columns']['card_id'],
                $data['columns']['creator'],
                $data['columns']['creator_admin_id'],
                $data['columns']['creator_staff_id'],
            );

            $staff_agency_id = Auth::guard('staff')->user()->agency_id;
            if ($staff_agency_id > 0) {
                $clientColumns = array_map(fn($column) => 'clients.' . $column, array_keys($data['columns']));
                $selectColumns = array_merge($clientColumns, ['cards.name as card_name']);

                $data['rows'] = Client::where('agency_id', $staff_agency_id)
                    ->leftJoin('cards', 'cards.id', '=', 'clients.card_id')
                    ->select($selectColumns)
                    ->get();

                $data['columns'] = insertAfterKey($data['columns'], 'gender', 'card_name', ['text' => 'card', 'th_class' => '']);
            } else {
                return redirect()->route('logout');
            }
        }

        return view('pages.dashboard.clients.clients', compact('data'));
    }

    public function create()
    {
        $data['agencies'] = Agency::where('active', 1)->get(['id', 'name']);
        $data['cards'] = Card::where('active', 1)->get(['id', 'name']);

        if (!$data['agencies']->count() || !$data['cards']->count()) {
            $errorMessage = 'Pour créer un nouveau client, vous devez avoir au moins '
                . (!$data['agencies']->count() ? 'une agence active' : '')
                . (!$data['agencies']->count() && !$data['cards']->count() ? ' et ' : '')
                . (!$data['cards']->count() ? 'une carte active' : '');

            return redirect()->route('clients')->withErrors(['error' => $errorMessage]);
        }

        return view('pages.dashboard.clients.add', compact('data'));
    }

    public function insert(Request $request)
    {
        try {
            $roles = [
                'cin' => 'nullable|string|max:10',
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:50',
                'email' => 'nullable|email|unique:clients,email',
                'phone_number' => 'required|string|max:20|unique:clients,phone_number',
                'gender' => ['required', Rule::in(['male', 'female'])],
                'birth_date' => 'nullable|date',
                'address' => 'nullable|string|max:255',
                'card_id' => 'required|string|max:255',
                'optional_name' => 'nullable|string|max:50',
                'wallet' => 'nullable|numeric|min:0',
                'expiry_date' => 'nullable|date|after_or_equal:today',
                'message' => 'string|max:1000',
            ];
            $errors = [
                'cin.max' => 'Le numéro CIN ne peut pas dépasser 10 caractères.',
                'first_name.max' => 'Le prénom ne peut pas dépasser 30 caractères.',
                'last_name.max' => 'Le nom de famille ne peut pas dépasser 50 caractères.',
                'email.email' => 'L’adresse e-mail doit être valide.',
                'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
                'phone_number.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
                'phone_number.unique' => 'Ce numéro de téléphone est déjà utilisé.',
                'gender.in' => 'Le genre doit être soit "male" soit "female".',
                'birth_date.date' => 'La date de naissance doit être une date valide.',
                'address.max' => 'L’adresse ne peut pas dépasser 255 caractères.',
                'card_id.max' => 'Le type de carte ne peut pas dépasser 255 caractères.',
                'wallet.numeric' => 'Le solde doit être un nombre.',
                'wallet.min' => 'Le solde ne peut pas être négatif.',
                'expiry_date.date' => 'La date d’expiration doit être une date valide.',
                'expiry_date.after_or_equal' => 'La date d’expiration doit être aujourd’hui ou une date future.',
                'message.string' => 'Le champ "message" doit être une chaîne de caractères.',
                'message.max' => 'Le champ "message" ne peut pas dépasser 1000 caractères.',
            ];

            if (Auth::guard('admin')->check()) {
                $roles['agency_id'] = 'required|integer';
                $errors['agency_id.required'] = 'L’agence spécifiée n’existe pas.';
                $errors['agency_id.integer'] = 'L’agence était fermée pendant que vous remplissez les champs.';
            }

            $request->validate($roles, $errors);

            $cards_row = Card::select('period')->where('id', $request->card_id)->first();

            $expiry_date = Carbon::now()->addDays($cards_row['period']);

            $generateCardSerial = function () {
                $rand = fn() => str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
                return $rand() . $rand() . $rand() . $rand();
            };

            do {
                $card_serial = $generateCardSerial();
            } while (Client::where('card_serial', $card_serial)->exists());

            $validation_key = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $is_admin = Auth::guard('admin')->check();

            $createClient = Client::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'cin' => $request->cin,
                'birth_date' => $request->birth_date,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'address' => $request->address,
                'email' => $request->email,

                'optional_name' => $request->optional_name,
                'card_serial' => $card_serial,
                'expiry_date' => $expiry_date,
                'card_id' => $request->card_id,

                'validationKey' => $is_admin ? $validation_key : null,
                'creator' => $is_admin ? 'admin' : 'staff',
                'agency_id' => $is_admin ? $request->agency_id : Auth::guard('staff')->user()->agency_id,
                'creator_admin_id' => $is_admin ? Auth::guard('admin')->id() : null,
                'creator_staff_id' => !$is_admin ? Auth::guard('staff')->id() : null,
            ]);

            $ui_errors = [];
            if ($createClient) {
                if ($request->wallet) {
                    if ($is_admin) {
                        $createTransaction = Transaction::create([
                            'actor' => 'admin',
                            'admin_id' => Auth::guard('admin')->id(),
                            'client_id' => $createClient->id,
                            'client_status' => $createClient->status,
                            'points' => $request->wallet,
                            'description' => json_encode([
                                'history' => [],
                                'confirmed' => [
                                    'at' => Carbon::now()->toDateTimeString(),
                                    'client_status' => $createClient->status,
                                    'wallet' => $createClient->wallet,
                                    'add' => $request->wallet,
                                    'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                                    'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                                    'message' => $request->message
                                ],
                            ])
                        ]);
                        if (!($createTransaction && $createClient->update(['wallet' => (float)$request->wallet]))) {
                            $createTransaction->delete();
                            $ui_errors[] = '';
                        }
                    } else {
                        $pending_transaction = PendingTransaction::create([
                            'staff_id' => Auth::guard('staff')->id(),
                            'client_id' => $createClient->id,
                            'points' => $request->wallet,
                            'description' => json_encode([
                                'history' => [
                                    Carbon::now()->toDateTimeString() => [
                                        'client_status' => $createClient->status,
                                        'wallet' => $createClient->wallet,
                                        'add' => $request->wallet,
                                        'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                                        'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                                        'message' => $request->message
                                    ]
                                ],
                                'confirmed' => [],
                            ])
                        ]);
                        if ($pending_transaction) $ui_errors[] = '';
                    }
                }
            } else $ui_errors[] = '';

            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id) // error check
    {
        $columns = [
            'id',
            'cin',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'gender',
            'birth_date',
            'address',
            'card_id',
            'optional_name',
            'wallet',
            'expiry_date',
        ];

        if (Auth::guard('admin')->check()) {
            $columns[] = 'agency_id';
            $data['agencies'] = Agency::select('id', 'name')->get();

//            if (!$data['agencies']) {
//                return redirect()->Route('clients')->withErrors(['error' => 'the client branch was deleted']);
//            }

        };
        $data['cards'] = Card::select('id', 'name')->get();

        $data['row'] = Client::select($columns)->find($id);

        if (Auth::guard('admin')->check() && $data['row'] && $data['row']['agency_id']) {
            $data['row']['agency_name'] = Agency::where('id', $data['row']['agency_id'])->value('name');
        }

        if ($data['row'] && $data['row']['card_id']) {
            $data['row']['card_name'] = Card::where('id', $data['row']['card_id'])->value('name');
        }

//        return $data;

        return view('pages.dashboard.clients.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            /* validation */
            $roles = [
                'cin' => 'nullable|string|max:10',
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:50',
                'email' => 'nullable|email|unique:clients,email,' . $id,
                'phone_number' => 'required|string|max:20|unique:clients,phone_number,' . $id,
                'gender' => ['required', Rule::in(['male', 'female'])],
                'birth_date' => 'nullable|date',
                'address' => 'nullable|string|max:255',
                'card_id' => 'required|string|max:255',
                'optional_name' => 'nullable|string|max:50',
                'wallet' => 'nullable|numeric|min:0',
                'expiry_date' => 'nullable|date|after_or_equal:today',
                'message' => 'string|max:1000',
            ];
            $errors = [
                'cin.max' => 'Le numéro CIN ne peut pas dépasser 10 caractères.',
                'first_name.max' => 'Le prénom ne peut pas dépasser 30 caractères.',
                'last_name.max' => 'Le nom de famille ne peut pas dépasser 50 caractères.',
                'email.email' => 'L’adresse e-mail doit être valide.',
                'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
                'phone_number.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
                'phone_number.unique' => 'Ce numéro de téléphone est déjà utilisé.',
                'gender.in' => 'Le genre doit être soit "male" soit "female".',
                'birth_date.date' => 'La date de naissance doit être une date valide.',
                'address.max' => 'L’adresse ne peut pas dépasser 255 caractères.',
                'card_id.max' => 'Le type de carte ne peut pas dépasser 255 caractères.',
                'wallet.numeric' => 'Le solde doit être un nombre.',
                'wallet.min' => 'Le solde ne peut pas être négatif.',
                'expiry_date.date' => 'La date d’expiration doit être une date valide.',
                'expiry_date.after_or_equal' => 'La date d’expiration doit être aujourd’hui ou une date future.',
                'message.string' => 'Le champ "message" doit être une chaîne de caractères.',
                'message.max' => 'Le champ "message" ne peut pas dépasser 1000 caractères.',
            ];

            if (Auth::guard('admin')->check()) {
                $roles['agency_id'] = 'required|integer';
                $errors['agency_id.required'] = 'L’agence spécifiée n’existe pas.';
                $errors['agency_id.integer'] = 'L’agence était fermée pendant que vous remplissez les champs.';
            }

            $request->validate($roles, $errors);

            /* target */
            $client = Client::find($id);

            /* errors */
            if (!$client && $client->status === 'pending') return back()->withErrors(['error' => 'Client non trouvé.']);
            if ($client->status === 'pending') return back()->withErrors(['error' => 'le client déjà actifs.']);
            if (!Card::find($request->card_id)->exists()) return back()->withErrors(['card_id' => 'La carte spécifiée n’existe pas.']);
            if (Auth::guard('admin')->check() && $request->agency_id && !Agency::find($request->agency_id)) return back()->withErrors(['agency_id' => 'L’agence spécifiée n’existe pas.']);

            /* update */
            $updateData = [];

            $fields = [
                'first_name',
                'last_name',
                'cin',
                'birth_date',
                'phone_number',
                'gender',
                'address',
                'email',
                'optional_name',
                'card_id'
            ];

            foreach ($fields as $field) {
                if ($request->$field !== null && $request->$field != $client->$field) {
                    $updateData[$field] = $request->$field;
                }
            }

            if (Auth::guard('admin')->check()) {
                if ($request->agency_id != $client->agency_id) {
                    $updateData['agency_id'] = $request->agency_id;
                }

                if ($request->agency_id != $client->agency_id) {
                    $updateData['agency_id'] = $request->agency_id;
                }

                if ((float)$client->wallet !== (float)$request->wallet) {

                    $oldest_transaction = Transaction::where('client_id', $id)
                        ->orderBy('created_at', 'asc')
                        ->first();

                    if ($oldest_transaction) {
                        $description = json_decode($oldest_transaction->description);
                        $description->history[Carbon::now()->toDateTimeString()] = $description->confirmed;
                        $description->confirmed = [
                            'at' => Carbon::now()->toDateTimeString(),
                            'client_status' => $client->status,
                            'wallet' => $description->confirmed->wallet,
                            'add' => $request->wallet,
                            'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                            'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                            'message' => $request->message
                        ];

                        $oldest_transaction->description = json_encode($description);

                        if ($oldest_transaction->save()) {
                            return $client->update(['wallet' => $request->wallet]) ? redirect()->route('clients') : redirect()->route('clients')->withError(['error' => 'transaction échouée']);
                        } else {
                            return redirect()->route('clients')->withError(['error' => 'transaction échouée']);
                        }
                    } else {
                        $description = [
                            'history' => [],
                            'confirmed' => [
                                'at' => Carbon::now()->toDateTimeString(),
                                'client_status' => $client->status,
                                'wallet' => $client->wallet,
                                'add' => $request->wallet,
                                'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                                'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                                'message' => $request->message
                            ],
                        ];

                        $transaction = new Transaction;
                        $transaction->actor = 'admin';
                        $transaction->admin_id = Auth::guard('admin')->user()->id;
                        $transaction->client_id = $client->id;
                        $transaction->points = $request->wallet;
                        $transaction->description = json_encode($description);

                        if ($transaction->save() && $client->update(['wallet' => $request->wallet])) {
                            return redirect()->route('clients');
                        } else {
                            $transaction->delete();
                            return redirect()->route('clients')->withError(['error' => 'transaction échouée']);
                        }
                    }
                }
            } elseif (Auth::guard('staff')->check()) {
                $updateData['agency_id'] = Auth::guard('staff')->user()->agency_id;

                // $updateData['wallet'] = $request->wallet;
            }

            if (!empty($updateData)) {
                $updateData['validationKey'] = str_pad(random_int(0, 9999), 6, '0', STR_PAD_LEFT);
                $client->update($updateData);
            }

            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function active($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('clients')->withErrors(['error' => 'ID de client invalide.']);
        }

        $client = Client::find($id);

        if (!$client) {
            return redirect()->route('clients')->withErrors(['error' => 'Client non trouvé.']);
        }

        // Vérifier le statut du client
        if ($client->status !== 'expired') {
            if ($client->status === 'disactivited') {
                $client->status = $client->validationKey ? 'invalid' : 'active';
            } elseif ($client->status === 'invalid') {
                $client->status = 'active';
                $client->validationKey = null;
            }
        } else {
            return redirect()->route('clients')->withErrors(['info' => 'Le client n\'est pas invalide.']);
        }

        try {
            $client->save();
            return redirect()->route('clients');
        } catch (\Exception $e) {
            return redirect()->route('clients')->withErrors(['error' => 'Échec de la mise à jour du statut du client.']);
        }
    }

    public function renew($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('clients')->with(['error', 'Invalid client ID.']);
        }
        $clientRow = Client::find($id);
        $cardRow = Card::select('period')->find($id);
        if (!$clientRow) return redirect()->route('clients')->with(['error', 'Client not found.']);
        if ($clientRow->status !== 'pending') return redirect()->route('clients')->withErrors(['error' => '']);
        return $clientRow->update([
            'status' => 'active',
            'expiry_date' => Carbon::parse($clientRow->expiry_date)
                ->addDays($cardRow->period)
                ->format('y/m/d')
        ])
            ? redirect()->route('clients')
            : redirect()->route('clients')->withErrors(['error', '']);
    }

    public function deactivate($id)
    {
        // Validate the ID
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('clients')->with(['error', 'Invalid client ID.']);
        }


        // Find the client by ID
        $client = Client::find($id);

        if (!$client) {
            return redirect()->route('clients')->with(['error', 'Client not found.']);
        }


        // Check the status
        if ($client->status === 'expired') {
            return redirect()->route('clients')->with(['info', 'Client is already expired.']);
        }
        if ($client->status === 'deactivated') {
            return redirect()->route('clients')->with(['info', 'Client is already deactivated.']);
        }


        // Update client status

        $client->status = 'disactivited';

        try {
            $client->save();
            return redirect()->route('clients')->with(['success', 'Client status updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->route('clients')->with(['error', 'Failed to update client status.']);
        }
    }

    public function history($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('clients')->withErrors(['error' => 'ID de client invalide.']);
        }

        // Define the columns for each table
        $columns = [
            'clients' => [
                "id", "first_name", "last_name", "cin", "birth_date",
                "phone_number", "gender", "address", "email",
                "optional_name", "card_serial", "wallet", "expiry_date",
                "card_id", "status", "creator", "agency_id",
                "creator_admin_id", "creator_staff_id"
            ],
            'histories' => ["data as client_histories"],
            'agencies' => ["name as agency_name"],
            'cards' => ["name as card_name"],
        ];

        // Prepare the selection array with fully qualified column names
        $selection = array_merge(
            ...array_map(
                function ($tab, $cols) {
                    return array_map(
                        function ($col) use ($tab) {
                            return "$tab.$col";
                        },
                        $cols
                    );
                },
                array_keys($columns),
                $columns
            )
        );

        // Build the query
        $data['row'] = Client::select($selection)
            ->leftJoin('agencies', 'agencies.id', '=', 'clients.agency_id')
            ->leftJoin('cards', 'cards.id', '=', 'clients.card_id')
            ->leftJoin('histories', 'histories.client_id', '=', 'clients.id')
            ->where('clients.id', $id) // Ensure you reference 'clients.id' to avoid ambiguity
            ->first();


        $admin_id = $data['row']->creator_admin_id;
        $staff_id = $data['row']->creator_staff_id;

        $creator = is_numeric($admin_id) && !is_numeric($staff_id) ?
            Admin::select('first_name', 'last_name')->where('id', $admin_id)->first()
            : (
            !is_numeric($admin_id) && is_numeric($staff_id)
                ? Staff::select('first_name', 'last_name')->where('id', $staff_id)->first()
                : null);

        if ($creator) {
            $data['row']['creator'] = "{$data['row']['creator']}.$creator->first_name $creator->last_name";
        } else return redirect()->Route('clients')->WithErrors(['error' => 'vous avez un problème dans les informations client']);

        unset(
            $data['row']['card_id'],
            $data['row']['agency_id'],
            $data['row']['creator_admin_id'],
            $data['row']['creator_staff_id']
        );
//        return $data;

        return view('pages.dashboard.clients.status', compact('data'));
    }

    public function searchForCard(Request $request)
    {
        try {
            if (!ctype_digit($request->card_serial)) return redirect()->route('clients')->withErrors(['error' => 'Le numéro de carte doit être numérique.']);
            if (strlen($request->card_serial) !== 16) return redirect()->route('clients')->withErrors(['error' => 'Le numéro de carte doit comporter 16 chiffres.']);

            return Redirect()->Route('clients.wallet', $request->card_serial);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function wallet($card_serial)
    {
        if (!ctype_digit($card_serial)) return redirect()->route('clients')->withErrors(['error' => 'Le numéro de carte doit être numérique.']);
        if (strlen($card_serial) !== 16) return redirect()->route('clients')->withErrors(['error' => 'Le numéro de carte doit comporter 16 chiffres.']);

        $card_serial = (string)$card_serial;

        $data = [
            'clients' => [
                'columns' => [
                    'clients.id',
                    'clients.first_name',
                    'clients.last_name',
                    'clients.cin',
                    'clients.birth_date',
                    'clients.phone_number',
                    'clients.gender',
                    'clients.address',
                    'clients.email',
                    'clients.optional_name',
                    'clients.wallet',
                    'clients.card_id',
                    'clients.card_serial',
                    'cards.name as card_name',
                    'clients.status',
                    'clients.agency_id',
                    'agencies.name as agency_name'
                ]
            ],
            'admins' => [
                'columns' => [
                    "first_name",
                    "last_name",
                    "phone_number",
                    "gender",
                    "email",
                ]
            ],
            'staffs' => [
                'columns' => [
                    "staffs.first_name",
                    "staffs.last_name",
                    "staffs.phone_number",
                    "staffs.gender",
                    "staffs.email",
                    "agencies.name as agency_name",
                ]
            ]
        ];

        $data['clients']['row'] = Client::select(...$data['clients']['columns'])
            ->leftJoin('cards', 'cards.id', 'clients.card_id')
            ->leftJoin('agencies', 'agencies.id', 'clients.agency_id')
            ->where('clients.card_serial', $card_serial)
            ->first();

        if (!$data['clients']['row']) return redirect()->route('clients')->withErrors(['error' => '']);

        if (Auth::guard('admin')->check()) {
            $data['admins']['row'] = Admin::select(...$data['admins']['columns'])
                ->where('id', Auth::guard('admin')->id())
                ->first();
            if (!$data['admins']['row']) return redirect()->route('clients')->withErrors(['error' => '']);
        } elseif (Auth::guard('staff')->check()) {
            $data['staffs']['row'] = Staff::select(...$data['staffs']['columns'])
                ->leftJoin('agencies', 'agencies.id', 'staffs.agency_id')
                ->where('staffs.id', Auth::guard('staff')->id())
                ->first();
            if (!$data['staffs']['row']) return redirect()->route('clients')->withErrors(['error' => '']);
        } else  return redirect()->route('clients')->withErrors(['error' => '']);


        return view('pages.dashboard.clients.wallet', compact('data'));
    }

    public function transaction(Request $request, $card_serial)
    {
        try {
            // Ensure the card_serial is treated as a string to handle large numbers
            if (!is_numeric($card_serial) || strlen($card_serial) !== 16) {
                return redirect()->route('clients')->withErrors(['error' => 'Invalid card serial.']);
            }

            // Convert card_serial to string to avoid integer precision issues
            $card_serial = (string)$card_serial;

            if (!is_numeric($request->points) || $request->points == 0) {
                return Back()->withErrors(['error' => '']);
            }

            $request->validate([
                'points' => 'required|numeric',
                'message' => 'required|string|max:1000',
            ], [
                'points.required' => 'Les points sont requis.',
                'points.numeric' => 'Les points doivent être un nombre.',
                'points.different' => 'Les points ne peuvent pas être égaux à 0.',

                'message.required' => 'Le message est requis.',
                'message.string' => 'Le message doit être une chaîne de caractères.',
                'message.max' => 'Le message ne peut pas dépasser 1000 caractères.',
            ]);

            $rowOfClients = Client::where('card_serial', $card_serial)->first(); // Retrieve the first matching client
            $checkOfPendingTransactions = PendingTransaction::where([
                ['client_id', $rowOfClients->id],
                ['accepted', false],
            ])->exists();

            if ($checkOfPendingTransactions) return redirect()->route('clients')->withErrors(['error' => '']);

            if (!$rowOfClients) {
                return redirect()->route('clients')->withErrors(['error' => 'Client not found.']);
            }

            if (Auth::guard('admin')->check()) {
                $description = [
                    'history' => [],
                    'confirmed' => [
                        'client_status' => $rowOfClients->status,
                        'wallet' => $rowOfClients->wallet,
                        'add' => $request->wallet,
                        'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                        'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                        'message' => $request->message
                    ],
                ];

                $transaction = new Transaction;
                $transaction->actor = 'admin';
                $transaction->admin_id = Auth::guard('admin')->user()->id;
                $transaction->client_id = $rowOfClients->id;
                $transaction->points = $request->points;
                $transaction->description = json_encode($description);

                if ($transaction->save() && $rowOfClients->update(['wallet' => $rowOfClients->wallet + $request->points])) {
                    return redirect()->route('clients');
                } else {
                    $transaction->delete();
                    return redirect()->route('clients')->withError(['error' => 'transaction échouée']);
                }
            } elseif (Auth::guard('staff')->check()) {

                $description = [
                    'history' => [
                        Carbon::now()->toDateTimeString() => [ // Format as "year-month-day hour:minutes:seconds"
                            'client_status' => $rowOfClients->status,
                            'wallet' => $rowOfClients->wallet,
                            'add' => $request->points,
                            'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                            'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                            'message' => $request->message
                        ]
                    ],
                    'confirmed' => [],
                ];


                $pending_transaction = new PendingTransaction;
                $pending_transaction->staff_id = Auth::guard('staff')->user()->id;
                $pending_transaction->client_id = $rowOfClients->id;
                $pending_transaction->points = $request->points;
                $pending_transaction->description = json_encode($description);

                if ($pending_transaction->save()) {
                    return redirect()->route('clients');
                } else {
                    return redirect()->route('clients')->withError(['error' => 'transaction échouée']);
                }
            }

            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
