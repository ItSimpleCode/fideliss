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

        /* Cards */
        // --  clients
        $clients_cards = Client::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $before_clients_cards = Client::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  cards
        $clientsCards_cards = ClientCards::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $before_clientsCards_cards = ClientCards::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  transactions
        $transactions_cards = Transaction::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->sum('points');
        $before_transactions_cards = Transaction::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->sum('points');

        $cards = [
            'clients' => [
                'new' => $clients_cards,
                'before' => $before_clients_cards,
            ],
            'cards' => [
                'new' => $clientsCards_cards,
                'before' => $before_clientsCards_cards,
            ],
            'transactions' => [
                'new' => $transactions_cards,
                'before' => $before_transactions_cards,
            ],
        ];

        /* Chart */
        // --  transactions
        $transactions_chart = Transaction::select('id', 'points', 'created_at')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->get();

        // --  statistique
        $typeCards_chart = Card::select('id', 'name')
            ->withCount('clientcards')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->orderBy('clientcards_count', 'desc')
            ->get();

        // --  cards
        $cards_chart = DB::table('cards')
            ->whereBetween('cards.created_at', [$date['dateStart'], $date['dateEnd']])
            ->join('client_cards', 'cards.id', '=', 'client_cards.id_card')
            ->leftJoin('transactions', 'client_cards.id', '=', 'transactions.id_client_card')
            ->whereBetween('client_cards.created_at', [$date['dateStart'], $date['dateEnd']])
            ->select('cards.name as card_name', 'cards.id as card_id', DB::raw('SUM(transactions.points) as total_points'))
            ->groupBy('cards.id', 'cards.name')
            ->get()
            ->map(function ($item) {
                return [
                    'card_name' => $item->card_name,
                    'total_points' => $item->total_points ?? 0,
                ];
            })
            ->toArray();

        $charts = [
            'transactions' => $transactions_chart,
            'typeCards' => $typeCards_chart,
            'cards' => $cards_chart,
        ];

        /* branch table */
        $branches = DB::table('branchs')
            ->select('branchs.name as branch_name')
            ->addSelect(DB::raw('COUNT(DISTINCT staffs.id) as staff_count'))
            ->addSelect(DB::raw('COUNT(DISTINCT clients.id) as client_count'))
            ->addSelect(DB::raw('COUNT(DISTINCT client_cards.id) as client_card_count'))
            ->addSelect(DB::raw('SUM(transactions.points) as total_points'))
            ->leftJoin('staffs', 'staffs.id_branch', '=', 'branchs.id')
            ->leftJoin('clients', 'clients.id_branch', '=', 'branchs.id')
            ->leftJoin('client_cards', 'client_cards.id_client', '=', 'clients.id')
            ->leftJoin('transactions', 'transactions.id_client_card', '=', 'client_cards.id')
            ->whereBetween('transactions.created_at', [$date['dateStart'], $date['dateEnd']])
            ->groupBy('branchs.name')
            ->orderBy('total_points', 'desc')
            ->get();

        $branchTable = [
            'columns' => [
                'branch_name' => 'branches',
                'staff_count' => 'clients',
                'client_count' => 'personnel',
                'client_card_count' => 'client cards',
                'total_points' => 'transactions total',
            ],
            'rows' => $branches,
        ];

        return view(
            'pages.dashboard.statistics.statistics',
            compact(
                'date',
                'cards',
                'charts',
                'branchTable'
            )
        );
    }
}
