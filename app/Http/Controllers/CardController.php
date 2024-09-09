<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Client;
use App\Models\ClientCards;
use App\Models\Transaction;
use App\Models\PendingTransaction;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class CardController extends Controller
{

    public function index()
    {
        $data['columns'] = [
            'id' => [],
            'name' => [
                'text' => 'Nom',
                'th_class' => '',
            ],
            'cost' => [
                'text' => 'Coût',
                'th_class' => '',
            ],
            'period' => [
                'text' => 'Période (jours)',
                'th_class' => '',
            ],
            'active' => [],
            'created_at' => [],
        ];

        $data['rows'] = Card::select(array_keys($data['columns']))
            ->withCount(['cards'])
            ->orderBy('created_at', 'desc')
            ->get();

        $data['columns']['clients_count'] = [
            'text' => 'clients',
            'th_class' => '',
        ];

        return view('pages.dashboard.cards.cards', compact('data'));
    }

    public function showClientCards($id)
    {

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer',
        ], [
            'id.required' => 'L\'identifiant est requis.',
            'id.integer' => 'L\'identifiant doit être un nombre entier.',
            'id.exists' => 'L\'identifiant fourni n\'existe pas dans notre base de données.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['error' => $validator->errors()]);
        }

        $clientCards = ClientCards::with(['cards'])
            ->where('id_client', $id)
            ->get();

        $data = $clientCards->isEmpty() ? [] : $clientCards->map(function ($clientCard) {
            return [
                'id' => $clientCard->id,
                'card_serial' => $clientCard->card_serial,
                'wallet' => $clientCard->wallet,
                'created_at' => $clientCard->created_at->toDateTimeString(),
                'expiry_date' => Carbon::parse($clientCard->expiry_date)->format('m/d'),
                'cards' => [
                    'name' => $clientCard->cards ? $clientCard->cards->name : 'N/A',
                    'duration' => $clientCard->cards ? $clientCard->cards->duration : 'N/A',
                    'active' => $clientCard->cards ? $clientCard->cards->active : 'N/A',
                ],
                'qrCode' => QrCode::size(100)->generate('/dashboard/addPoints/' . $clientCard->card_serial)
            ];
        });

        $clientNameData = Client::select('first_name', 'last_name')
            ->where('id', $id)
            ->first();
        $client_name = $clientNameData->first_name . ' ' . $clientNameData->last_name;
        $client = [$id, $client_name];

        return view('pages.dashboard.clients.cards', compact('data', 'client'));
    }

    public function showClientCardsAddForm($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer',
        ], [
            'id.required' => 'L\'identifiant est requis.',
            'id.integer' => 'L\'identifiant doit être un nombre entier.',
            'id.exists' => 'L\'identifiant fourni n\'existe pas dans notre base de données.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $client = Client::select('id', 'first_name', 'last_name', 'phone_number', 'email', 'active')
            ->where('id', $id)
            ->first();

        if (!$client->active) {
            return back()->withErrors(['error' => 'Le client associé à cette carte n\'est pas actif.']);
        }

        $cards = Card::all();

        $clientCards = ClientCards::where('id_client', $id)->get();
        return view('pages.dashboard.cards.add', compact('client', 'cards', 'clientCards'));
    }

    public function addCardToClient(Request $request, $id)
    {
        try {
            $request->validate([
                'card_type' => 'required|string|max:255',
                'wallet' => 'required|numeric|min:0',
            ], [
                'card_type.required' => 'Le type de carte est requis.',
                'card_type.string' => 'Le type de carte doit être une chaîne de caractères.',
                'card_type.max' => 'Le type de carte ne peut pas dépasser 255 caractères.',

                'wallet.required' => 'Le montant du portefeuille est requis.',
                'wallet.numeric' => 'Le montant du portefeuille doit être un nombre.',
                'wallet.min' => 'Le montant du portefeuille doit être au moins 0.',
            ]);

            $cardSelected = Card::find($request->card_type);

            if ($cardSelected) {
                $clientCard = new ClientCards;
                $clientCard->id_client = $request->id;
                $clientCard->id_card = $cardSelected->id;

                do {
                    $serial = rand(1000000000000000, 9999999999999999);
                } while (ClientCards::where('card_serial', $serial)->exists());

                $clientCard->card_serial = $serial;
                $clientCard->wallet = $request->wallet;

                if (Auth::guard('admin')->check()) {
                    $clientCard->id_creator = Auth::guard('admin')->user()->id;
                    $clientCard->creator_type = 'admin';
                } else if (Auth::guard('staff')->check()) {
                    $clientCard->id_creator = Auth::guard('staff')->user()->id;
                    $clientCard->creator_type = 'staff';
                }

                $expiryDate = Carbon::today()->addDays($cardSelected->period);
                $clientCard->expiry_date = $expiryDate;
                $clientCard->save();
                return redirect()->route('client.cards', ['id' => $id]);
            }

            return back()->withErrors(['error' => 'Ooops, quelque chose s\'est mal passé. Veuillez réessayer dans quelques minutes.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showScannerPage()
    {
        return view('pages.dashboard.scanner.scanner');
    }

    public function showAddPointsPageByScanning($card_serial)
    {

        // Validate the input
        $validator = Validator::make(['card_serial' => $card_serial], [
            'card_serial' => 'required|string|size:16',
        ], [
            'card_serial.required' => 'Le numéro de série de la carte est requis.',
            'card_serial.string' => 'Le numéro de série de la carte doit être une chaîne de caractères.',
            'card_serial.size' => 'Le numéro de série de la carte doit comporter exactement :size caractères.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['error' => $validator->errors()]);
        }

        $card = ClientCards::with('client', 'cards')
            ->where('card_serial', $card_serial)
            ->first();


        if (!$card) {
            return back()->withErrors(['error' => 'Carte non trouvée. Veuillez vérifier le numéro de série et réessayer.']);
        }

        if (!$card->client->active) {
            return back()->withErrors(['error' => 'Le client associé à cette carte n\'est pas actif.']);
        }

        $data = [
            'id' => $card->id,
            'card_serial' => $card->card_serial,
            'wallet' => $card->wallet,
            'expiry_date' => Carbon::parse($card->expiry_date)->format('m/d'),
            'type' => $card->cards->name,
            'client' => [
                'first_name' => $card->client->first_name,
                'last_name' => $card->client->last_name,
                'birth_date' => $card->client->birth_date,
                'phone_number' => $card->client->phone_number,
                'gender' => $card->client->gender,
                'address' => $card->client->address,
                'email' => $card->client->email,
            ],
            'created_at' => $card->created_at->format('Y-m-d H:i:s'),
            'qrCode' => QrCode::size(100)->generate('/dashboard/addPoints/' . $card->card_serial)
        ];

        return view('pages.dashboard.scanner.add_points', compact('data'));
    }

    public function showAddPointsPageByhand(Request $request)
    {

        try {
            $request->validate([
                'card_serial' => 'required|integer|digits:16',
            ], [
                'card_serial.required' => 'Le numéro de série de la carte est requis.',
                'card_serial.integer' => 'Le numéro de série de la carte doit être un nombre entier.',
                'card_serial.digits' => 'Le numéro de série de la carte doit contenir exactement 16 chiffres.',
            ]);

            return Redirect()->Route('clients.wallet', ['card_serial', $request->card_serial]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function AddPointsToCard(Request $request, $id)
    {
        try {
            $request->validate([
                'points' => 'required|numeric|min:0',
                'description' => 'required|string|max:1000',
            ], [
                'points.required' => 'Les points sont requis.',
                'points.numeric' => 'Les points doivent être un nombre.',
                'points.min' => 'Les points doivent être au moins 0.',

                'description.required' => 'La description est requise.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            ]);

            $card = ClientCards::find($id);

            if (Auth::guard('staff')->check()) {
                $demande = new PendingTransaction;
                $demande->id_client_card = $card->id;
                $demande->points = $request->points;
                $demande->id_money_converter = Auth::guard('staff')->user()->id;
                $demande->description = $request->description;
                $demande->status = 'Waiting';
                $demande->save();
                return redirect()->route('transaction.demande');
            }

            $card->wallet = $card->wallet + $request->points;
            $card->update();


            $transaction = new Transaction;
            $transaction->id_client_card = $card->id;
            $transaction->points = $request->points;
            $transaction->id_money_converter = $request->points;
            if (Auth::guard('admin')->check()) {
                $transaction->id_money_converter = Auth::guard('admin')->user()->id;
                $transaction->type_money_converter = 'admin';
            } else if (Auth::guard('staff')->check()) {
                $transaction->id_money_converter = Auth::guard('staff')->user()->id;
                $transaction->type_money_converter = 'staff';
            }
            $transaction->description = $request->description;
            $transaction->save();
            $client = $card->client;  // Assuming the relationship between ClientCards and Client is defined
            $clientPhone = $client->phone_number;  // Assuming the client's phone number is stored in phone_number column

            $accessToken = env('META_WHATSAPP_ACCESS_TOKEN');
            $phoneNumberId = env('META_WHATSAPP_PHONE_NUMBER_ID');

            $message = "Bonjour {$client->first_name}, {$request->points} points ont été ajoutés à votre carte.";

            $response = Http::withToken($accessToken)->post("https://graph.facebook.com/v16.0/{$phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $clientPhone,
                'type' => 'text',
                'text' => [
                    'body' => $message
                ],
            ]);

            return redirect()->route('client.cards', ['id' => $card->id_client]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function changeStatus($id)
    {
        $card = Card::find($id);
        $card->active = !$card->active;
        $card->update();
        return redirect()->route('cards');
    }

    public function create()
    {
        return view('pages.dashboard.cards.add');
    }

    public function insert(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|min:0',
                'period' => 'required|integer|min:1',
                'active' => 'required|boolean',
            ], [
                'name.required' => 'Le nom est obligatoire.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
                'cost.required' => 'Le coût est obligatoire.',
                'cost.numeric' => 'Le coût doit être un nombre.',
                'cost.min' => 'Le coût doit être un nombre positif.',
                'period.required' => 'La période est obligatoire.',
                'period.integer' => 'La période doit être un nombre entier.',
                'period.min' => 'La période doit être d\'au moins 1 jour.',
                'active.required' => 'Le champ actif est obligatoire.',
                'active.boolean' => 'Le champ actif doit être vrai ou faux.',
            ]);

            $card = new Card;
            $card->name = $request->name;
            $card->cost = $request->cost;
            $card->period = $request->period;
            $card->active = $request->active;
            $card->save();

            return redirect()->route('cards');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $data['row'] = Card::find($id);
        return view('pages.dashboard.cards.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|min:0',
                'period' => 'required|integer|min:1',
                'active' => 'required|boolean',
            ], [
                'name.required' => 'Le nom est obligatoire.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
                'cost.required' => 'Le coût est obligatoire.',
                'cost.numeric' => 'Le coût doit être un nombre.',
                'cost.min' => 'Le coût doit être un nombre positif.',
                'period.required' => 'La période est obligatoire.',
                'period.integer' => 'La période doit être un nombre entier.',
                'period.min' => 'La période doit être d\'au moins 1 jour.',
                'active.required' => 'Le champ actif est obligatoire.',
                'active.boolean' => 'Le champ actif doit être vrai ou faux.',
            ]);

            $card = Card::find($id);
            $card->name = $request->name;
            $card->cost = $request->cost;
            $card->period = $request->period;
            $card->active = $request->active;
            $card->update();
            return redirect()->route('cards');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
