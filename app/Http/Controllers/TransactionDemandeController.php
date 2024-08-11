<?php

namespace App\Http\Controllers;

use App\Models\TransactionDemande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionDemandeController extends Controller
{
    public function showByIdStaff()
    {
        $columns = ["serie de carte", "client", "points", 'description', "status"];
        $fields = ['card_serial', 'client', 'points', 'description', 'status'];
        $data = TransactionDemande::with('clientCards.client')
            ->where('id_money_converter', Auth::guard('staff')->user()->id)
            ->orderBy('created_at')
            ->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'card_serial' => $item->clientCards ? $item->clientCards->card_serial : null,
                'client' => $item->clientCards && $item->clientCards->client
                    ? $item->clientCards->client->first_name . ' ' . $item->clientCards->client->last_name
                    : null,
                'points' => $item->points,
                'description' => $item->description,
                'status' => $item->status
            ];
        });


        $table = 'demandes';

        return view('pages.dashboard.demandes.demandes', compact('data', 'columns', 'fields', 'table'));
    }

    public function annulerDemande($id)
    {
        TransactionDemande::find($id)->delete();
        return redirect()->route('transaction.demande');
    }
    public function showEditDemandePage($id)
    {
        $data = TransactionDemande::find($id);
        return view('pages.dashboard.demandes.edit', compact('data'));
    }
}
