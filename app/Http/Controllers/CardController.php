<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Client;
use App\Models\ClientCards;
use App\Models\Transaction;
use App\Models\TransactionDemande;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class CardController extends Controller
{

    public function index()
    {
        $columns = ["Nom", "Coût", "Période", "D.création"];
        $fields = ['name', 'cost', 'period', 'created_at'];
        $cards = Card::select('id', 'name', 'cost', 'period', 'active', 'created_at', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
        $data = $cards->map(function ($card) {
            return [
                'id' => $card->id,
                'name' => $card->name,
                'cost' => $card->cost,
                'period' => "$card->period jours",
                'active' => $card->active,
                'created_at' => $card->created_at,
            ];
        });

        $table = 'cards';

        return view('pages.dashboard.cards.cards', compact('data', 'columns', 'fields', 'table'));
    }

    public function showClientCards($id)
    {
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
        $client = Client::select('id', 'first_name', 'last_name', 'phone_number', 'email')
            ->where('id', $id)
            ->first();


        $cards = Card::all();
        $clientCards = ClientCards::where('id_client', $id)->get();
        return view('pages.dashboard.cards.add', compact('client', 'cards', 'clientCards'));
    }

    public function addCardToClient(Request $request, $id)
    {
        try {
            $request->validate([
                'card_type' => 'required',
                'wallet' => 'required|numeric',
            ], [
                'card_type.required' => 'Le type de carte est requis.',
                'wallet.required' => 'Le montant du portefeuille est requis.',
                'wallet.numeric' => 'Le montant du portefeuille doit être un nombre.',
            ]);


            $cardSelected = Card::find($request->card_type);
            if ($cardSelected) {
                $clientCard = new ClientCards;
                $clientCard->id_client = $request->id;
                $clientCard->id_card = $cardSelected->id;

                // Generate a unique serial
                do {
                    $serial = mt_rand(0000000000000000, 9999999999999999);
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
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function showScannerPage()
    {
        return view('pages.dashboard.scanner.scanner');
    }
    public function showAddPointsPageBySanning($card_serial)
    {
        $card = ClientCards::with('client', 'cards')
            ->where('card_serial', $card_serial)
            ->first();

        if (!$card) {
            return back()->withErrors(['error' =>  'Ooops, quelque chose s\'est mal passé. Veuillez réessayer dans quelques minutes.']);
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

        // return response()->json($data);
        return view('pages.dashboard.scanner.add_points', compact('data'));
    }


    public function showAddPointsPageByhand(Request $request)
    {
        $card = ClientCards::with('client', 'cards')
            ->where('card_serial', $request->card_serial)
            ->first();

        if (!$card) {
            return back()->withErrors(['error' =>  'Ooops, quelque chose s\'est mal passé. Veuillez réessayer dans quelques minutes.']);
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

    public function AddPointsToCard(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|numeric',
            'description' => 'required',
        ], [
            'points.required' => 'Les points sont requis.',
            'points.numeric' => 'Les points doivent être un nombre.',
            'description.required' => 'La description est requise.',
        ]);


        $card = ClientCards::find($id);

        if (Auth::guard('staff')->check()) {
            $demande = new TransactionDemande;
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

        return redirect()->route('client.cards', ['id' => $card->id_client]);
    }


    public function changeStatus($id)
    {
        $card = Card::find($id);
        $card->active = !$card->active;
        $card->update();
        return redirect()->route('cards');
    }

    public function showAddForm()
    {
        return view('pages.dashboard.cards.type_of_card');
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'cost' => 'required|numeric',
                'period' => 'required|int',
                'active' => 'required',
            ], [
                'name.required' => 'Le nom est requis.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'cost.required' => 'Le coût est requis.',
                'cost.numeric' => 'Le coût doit être un nombre.',
                'period.required' => 'La période est requise.',
                'period.int' => 'La période doit être un entier.',
                'active.required' => 'Le statut est requis.',
            ]);


            $card = new Card;
            $card->name = $request->name;
            $card->cost = $request->cost;
            $card->period = $request->period;
            $card->active = $request->active;
            $card->save();
            return redirect()->route('cards');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }


    public function showEditForm($id)
    {
        $card = Card::find($id);
        return view('pages.dashboard.cards.edit_type_of_card', compact('card'));
    }
    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'cost' => 'required|numeric',
                'period' => 'required|int',
                'active' => 'required',
            ], [
                'name.required' => 'Le nom est requis.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'cost.required' => 'Le coût est requis.',
                'cost.numeric' => 'Le coût doit être un nombre.',
                'period.required' => 'La période est requise.',
                'period.int' => 'La période doit être un entier.',
                'active.required' => 'Le statut est requis.',
            ]);


            $card = Card::find($id);
            $card->name = $request->name;
            $card->cost = $request->cost;
            $card->period = $request->period;
            $card->active = $request->active;
            $card->update();
            return redirect()->route('cards');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }
}
