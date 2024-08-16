<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Branch;
use App\Models\Card;
use App\Models\Client;
use App\Models\ClientCards;
use App\Models\Staff;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

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



        // --  clients statistique for cards
        $clientsData_cards = Client::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $old_clientsData_cards = Client::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  cards statistique for cards
        $clientsCardsData_cards = ClientCards::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $old_clientsCardsData_cards = ClientCards::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  transctions statistique for cards
        $transactionsData_cards = Transaction::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->sum('points');
        $old_transactionsData_cards = Transaction::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->sum('points');

        // --  transctions statistique for chart
        $transactionsData_chart = Transaction::select('id', 'points', 'created_at')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->get();


        // --  cards type statistique for chart
        $typeCardsData_chart = Card::select('id', 'name')
            ->withCount('clientcards')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->get();

        // --  cards statistique for chart
        $cardsData_chart = ClientCards::with('cards')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->get();
        $cardsData_chart = $cardsData_chart->map(function ($item) {
            return [
                'id' => $item->id,
                'created_at' => $item->created_at,
                'cardType' => $item->cards->name
            ];
        });

        // --  branch statistique for chart
        $branchesData_chart = Branch::withCount(['staffs', 'clients'])
            ->with('clients.clientCards.transactions')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->get();
        $branchesData_chart = $branchesData_chart->map(function ($branch) {
            $totalTransactions = 0;
            foreach ($branch->clients as $client) {
                foreach ($client->clientCards as $clientCard) {
                    $totalTransactions += $clientCard->transactions->count();
                }
            }
            return [
                'id' => $branch->id,
                'name' => $branch->name,
                'staffs_count' => $branch->staffs_count,
                'clients_count' => $branch->clients_count,
                'transactions_count' => $totalTransactions,
            ];
        });






        $data = [
            'clients' => [
                'new' => $clientsData_cards,
                'old' => $old_clientsData_cards,
            ],
            'cards' => [
                'new' => $clientsCardsData_cards,
                'old' => $old_clientsCardsData_cards,
            ],
            'transactions_card' => [
                'new' => $transactionsData_cards,
                'old' => $old_transactionsData_cards,
            ],
            'transactions_chart' => $transactionsData_chart,
            'typeCards_chart' => $typeCardsData_chart,
            'cardsData_chart' => $cardsData_chart,
            // 'branchesData_chart' => $branchesData_chart,
        ];

        // return $branchesData_chart;


        return view(
            'pages.dashboard.statistics.statistics',
            compact(
                'date',
                'data',
            )
        );

    }
}
