<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Client;
use App\Models\ClientCards;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CardController extends Controller
{

    public function index()
    {
        $columns = ['name', 'coast', 'period', 'status', 'creations date'];
        $fields = ['name', 'coast', 'period', 'active', 'created_at'];
        $cards = Card::select('id', 'name', 'coast', 'period', 'active', 'created_at')
            ->orderBy('created_at')
            ->get();
        $data = $cards->map(function ($card) {
            return [
                'id' => $card->id,
                'name' => $card->name,
                'coast' => $card->coast,
                'period' => $card->period . ' days',
                'active' => $card->active == 1 ? 'active' : 'desactive',
                'created_at' => $card->created_at,
            ];
        });

        $table = 'cards';
        return view('layouts.dashboard.cards.cards', compact('data', 'columns', 'fields', 'table'));
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
                'qrCode' => QrCode::size(100)->generate($clientCard->card_serial)
            ];
        });

        $clientNameData = Client::select('first_name', 'last_name')
            ->where('id', $id)
            ->first();
        $clientname = $clientNameData->first_name . ' ' . $clientNameData->last_name;
        $client = [
            $id, $clientname
        ];

        return view('layouts.dashboard.clients.cards', compact('data', 'client'));
    }

    public function showClientCardsAddForm($id)
    {
        $client = Client::select('id', 'first_name', 'last_name', 'phone_number', 'email')
            ->where('id', $id)
            ->first();


        $cards = Card::all();
        $clientCards = ClientCards::where('id_client', $id)->get();
        return view('layouts.dashboard.cards.add', compact('client', 'cards', 'clientCards'));
    }

    public function addCardToClient(Request $request, $id)
    {
        try {
            $request->validate([
                'card_type' => 'required|max:255',
                'card_serial' => 'required|string|max:255',
                'wallet' => 'required|numeric',
            ]);

            $cardSelected = Card::where('name', $request->card_type)->first();
            if ($cardSelected) {
                $clientCard = new ClientCards;
                $clientCard->id_client = $request->id;
                $clientCard->id_card = $cardSelected->id;
                $clientCard->card_serial = $request->card_serial;
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


            return back()->withErrors(['error' => 'You type an invalide data']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'something uncorrected ' . $e]);
        }
    }

    public function showScanPage()
    {
        return view('layouts.dashboard.scanner.scanner');
    }
    public function showAddPointsPage($card_serial)
    {
        $card = ClientCards::with('client', 'cards')
            ->where('card_serial', $card_serial)
            ->first();

        if (!$card) {
            return response()->json(['error' => 'Card not found'], 404);
        }

        $data = [
            'id' => $card->id,
            'card_serial' => $card->card_serial,
            'wallet' => $card->wallet,
            'expiry_date' => Carbon::parse($card->expiry_date)->format('m/d'),
            'type' => $card->cards->name,
            'client' => [
                'name' => $card->client->first_name . ' ' . $card->client->last_name,
                'birth_date' => $card->client->birth_date,
                'phone_number' => $card->client->phone_number,
                'gender' => $card->client->gender,
                'address' => $card->client->address,
                'email' => $card->client->email,
            ],
            'created_at' => $card->created_at->format('Y-m-d H:i:s'),
        ];

        // return response()->json($data);
        return view('layouts.dashboard.scanner.addPoints', compact('card'));
    }

    public function AddPointsToCard(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|numeric|max:255',
        ]);
        $card = ClientCards::find($id);
        $card->wallet = $card->wallet + $request->points;
        $card->update();
        return response()->json('points upgrated sucssucfully');
    }
}
