<?php

namespace App\Http\Controllers;

use App\Models\TransactionDemande;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    public function resendDemande($id)
    {
        $demande = TransactionDemande::find($id);
        $demande->status = 'Waiting';
        $demande->update();
        return redirect()->route('transaction.demande');
    }
    public function showEditDemandePage($id)
    {
        $data = TransactionDemande::with([
            'clientCards' => [
                'client',
                'cards'
            ]
        ])
            ->where('id', $id)
            ->first();

        $data =  [
            'id' => $data->id,
            'first_name' => $data->clientCards->client->first_name,
            'last_name' => $data->clientCards->client->last_name,
            'email' => $data->clientCards->client->email,
            'phone_number' => $data->clientCards->client->phone_number,
            'card_serial' => $data->clientCards->card_serial,
            'expiry_date' => Carbon::parse($data->clientCards->expiry_date)->format('m/d'),
            'wallet' => $data->clientCards->wallet,
            'type_card' => $data->clientCards->cards->name,
            'qrCode' => QrCode::size(100)->generate($data->clientCards->card_serial),
            'points' => $data->points,
            'description' => $data->description
        ];
        return view('pages.dashboard.demandes.edit', compact('data'));
    }
    public function EditDemande(Request $request, $id)
    {
        try {
            $request->validate([
                'points' => 'required',
                'description' => 'required|max:255',
            ]);

            $demande = TransactionDemande::find($id);
            $demande->points = $request->points;
            $demande->description = $request->description;
            $demande->update();

            return redirect()->route('transaction.demande');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'something uncorrected']);
        }
    }
}
