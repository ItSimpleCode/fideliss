<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Card;
use App\Models\Client;
use App\Models\Staff;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function index(Request $r)
    {
        $date = [
            'dateStart' => empty($r->dateStart) ? date('Y-m-d', strtotime('-30 days')) : date('Y-m-d', strtotime($r->dateStart)),
            'dateEnd' => empty($r->dateEnd) ? date('Y-m-d') : date('Y-m-d', strtotime($r->dateEnd)),
        ];

        $startDate = \Carbon\Carbon::parse($date['dateStart']);
        $endDate = \Carbon\Carbon::parse($date['dateEnd']);

        $daysDifference = $startDate->diffInDays($endDate);

        $previousStartDate = $startDate->copy()->subDays($daysDifference + 1)->format('Y-m-d');
        $previousEndDate = $endDate->copy()->subDays($daysDifference + 1)->format('Y-m-d');

        // Define columns and fields
        // $columns = ['serie de carte', 'client', 'converter', 'type converter', 'points'];
        // $fields = ['card_serial', 'client', 'converter', 'type_converter', 'points'];

        // $transaction = Transaction::with([
        //     'clientCards' => function ($query) {
        //         $query->with('client');
        //     }
        // ])
        //     ->whereDate('created_at', '>=', $date['dateStart'])
        //     ->whereDate('created_at', '<=', $date['dateEnd'])
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        // $transaction = $transaction->map(function ($item) {
        //     $converter = $item->type_money_converter == 'admin'
        //         ? Admin::find($item->id_money_converter)
        //         : Staff::find($item->id_money_converter);

        //     return [
        //         'id' => $item->id,
        //         'card_serial' => $item->clientCards->card_serial,
        //         'client' => $item->clientCards->client->first_name . ' ' . $item->clientCards->client->last_name,
        //         'type_converter' => $item->type_money_converter,
        //         'converter' => $converter ? $converter->first_name . ' ' . $converter->last_name : null,
        //         'points' => $item->points
        //     ];
        // });



        // --  clients statistique
        $clientsData = Client::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $old_clientsData = Client::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  cards statistique
        $cardsData = Card::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $old_cardsData = Card::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  transctions statistique
        $transactionsData = Transaction::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $old_transactionsData = Transaction::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        return view(
            'pages.dashboard.statistics.statistics',
            compact(
                'date',
                'clientsData',
                'old_clientsData',
                'cardsData',
                'old_cardsData',
                'transactionsData',
                'old_transactionsData'
            )
        );
    }
}
