<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Staff;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function showStatistics()
    {

        $columns = ['serie de carte','client','converter','type converter','points'];
        $fields = ['card_serial','client','converter','type_converter','points'];
        $data = Transaction::with([
            'clientCards' => ['client']
        ])
            ->orderBy('created_at')
            ->get();

            $data = $data->map(function($item) {
                $converter = $item->type_money_converter == 'admin' 
                    ? Admin::find($item->id_money_converter)
                    : Staff::find($item->id_money_converter);
            
                return [
                    'id' => $item->id,
                    'card_serial' => $item->clientCards->card_serial,
                    'client' => $item->clientCards->client->first_name . ' ' . $item->clientCards->client->last_name,
                    'type_converter' => $item->type_money_converter,
                    'converter' => $converter ? $converter->first_name . ' ' . $converter->last_name : null,
                    'points' => $item->points
                ];
            });

        // return response()->json($data);
        return view('pages.dashboard.statistics.statistics', compact('data','columns','fields'));
    }
}
