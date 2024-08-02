<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Client;
use App\Models\ClientCards;
use Illuminate\Http\Request;

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
                'period' => $card->period .' days',
                'active' => $card->active == 1 ? 'active' : 'desactive',
                'created_at' => $card->created_at,
            ];
        });

        $table = 'Cards';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }
    public function showClientCards($id)
    {
        $clientCards = ClientCards::with(['client', 'cards'])
            ->where('id_client', $id)
            ->get();

        $data = $clientCards->isEmpty() ? [] : $clientCards->map(function ($clientCard) {
            return [
                'id' => $clientCard->id,
                'card_serial' => $clientCard->card_serial,
                'wallet' => $clientCard->wallet,
                'created_at' => $clientCard->created_at->toDateTimeString(),
                'client' => [
                    'id' => $clientCard->client ? $clientCard->client->id : null,
                    'username' => $clientCard->client ? $clientCard->client->username : 'N/A',
                ],
                'cards' => [
                    'name' => $clientCard->cards ? $clientCard->cards->name : 'N/A',
                    'duration' => $clientCard->cards ? $clientCard->cards->duration : 'N/A',
                    'active' => $clientCard->cards ? $clientCard->cards->active : 'N/A',
                ],
            ];
        });

        $client = Client::select('username')
            ->where('id', $id)
            ->get();
        $clientname = $client[0]->username;

        return view('layouts.dashboard.client_cards', compact('data', 'clientname'));
    }
}
