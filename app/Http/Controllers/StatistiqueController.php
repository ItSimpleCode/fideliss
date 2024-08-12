<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Staff;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index(Request $r)
    {
        // Set the date range
        $date = [
            'dateStart' => empty($r->dateEnd) ? date('Y-m-d', strtotime('-30 days')) : date('Y-m-d', strtotime($r->dateEnd)),
            'dateEnd' => empty($r->dateStart) ? date('Y-m-d') : date('Y-m-d', strtotime($r->dateStart)),
        ];

        // Define columns and fields
        $columns = ['serie de carte', 'client', 'converter', 'type converter', 'points'];
        $fields = ['card_serial', 'client', 'converter', 'type_converter', 'points'];

        // Fetch data with date filtering
        $data = Transaction::with([
            'clientCards' => function ($query) {
                $query->with('client');
            }
        ])
            ->whereBetween('created_at', [$date['dateStart'], $date['dateEnd']])
            ->orderBy('created_at')
            ->get();

        // Map the data
        $data = $data->map(function ($item) {
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

        // Return the view with the filtered data, columns, fields, and date
        return view('pages.dashboard.statistics.statistics', compact('data', 'columns', 'fields', 'date'));
    }
}
