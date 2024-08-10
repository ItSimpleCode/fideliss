<?php

namespace App\Http\Controllers;

use App\Models\ClientCards;
use App\Models\Transaction;
use App\Models\TransactionDemande;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function index()
    {
        $columns = ["serie de carte", "client", "staff", "points", 'description'];
        $fields = ['card_serial', 'client', "staff", 'points', 'description'];
        $data = TransactionDemande::with('clientCards.client', 'staffs')
            ->where('status', 'Waiting')
            ->orderBy('created_at')
            ->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'card_serial' => $item->clientCards ? $item->clientCards->card_serial : null,
                'client' => $item->clientCards && $item->clientCards->client
                    ? $item->clientCards->client->first_name . ' ' . $item->clientCards->client->last_name
                    : null,
                'staff' => $item->staffs->first_name . ' ' . $item->staffs->last_name,
                'points' => $item->points,
                'description' => $item->description
            ];
        });
        $table = 'actions';
        return view('pages.dashboard.actions.actions', compact('data', 'table', 'columns', 'fields'));
    }

    public function valider($id)
    {
        $transactionDemande = TransactionDemande::find($id);

        $clientCard = ClientCards::find($transactionDemande->id_client_card);
        $clientCard->wallet =  $clientCard->wallet +  $transactionDemande->points;
        $clientCard->update();

        $transaction = new Transaction;
        $transaction->id_client_card = $transactionDemande->id_client_card;
        $transaction->points = $transactionDemande->points;
        $transaction->id_money_converter = $transactionDemande->id_money_converter;
        $transaction->type_money_converter = 'staff';
        $transaction->description = $transactionDemande->description;
        $transaction->save();

        $transactionDemande->status = 'Done';
        $transactionDemande->update();

        return redirect()->route('actions');
    }
    public function invalider($id)
    {
        $transactionDemande = TransactionDemande::find($id);
        $transactionDemande->status = 'Refused';
        $transactionDemande->update();

        return redirect()->route('actions');
    }
}
