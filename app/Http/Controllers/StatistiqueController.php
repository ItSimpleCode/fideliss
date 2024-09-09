<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agency;
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
        $data['cards']['clinets']['now'] = Client::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->count();
        $data['cards']['clinets']['before'] = Client::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->count();

        // --  transactions
        $data['cards']['transactions']['now'] = Transaction::whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->sum('points');
        $data['cards']['transactions']['before'] = Transaction::whereDate('created_at', '>=', $previousStartDate)
            ->whereDate('created_at', '<=', $previousEndDate)
            ->sum('points');

        /* Chart */
        // --  transactions
        $data['charts']['transactions'] = Transaction::selectRaw('DATE(created_at) as date, SUM(points) as points')
            ->whereDate('created_at', '>=', $startDate->format('Y-m-d'))
            ->whereDate('created_at', '<=', $endDate->format('Y-m-d'))
            ->groupBy('date')
            ->get();

        // --  statistique
        $data['charts']['type_of_cards'] = Card::select('id', 'name')
            ->withCount('cards')
            ->whereDate('cards.created_at', '>', $startDate)
            ->whereDate('cards.created_at', '<=', $endDate)
            ->orderBy('cards_count', 'desc')
            ->get();


        // --  cards
        $data['charts']['cards'] = DB::table('cards')
            ->select('cards.name as card_name', DB::raw('SUM(transactions.points) as total_points'))
            ->leftJoin('clients', 'cards.id', 'clients.card_id')
            ->leftJoin('transactions', 'clients.id', 'transactions.client_id')
            ->whereDate('cards.created_at', ">", $date['dateStart'])
            ->whereDate('cards.created_at', "<=", $date['dateEnd'])
            ->whereDate('transactions.created_at', ">", $date['dateStart'])
            ->whereDate('transactions.created_at', "<=", $date['dateEnd'])
            ->groupBy('cards.id', 'cards.name')
            ->get();

        /* branch table */
        $data['charts']['agencies']['columns'] = [
            'agency_name' => [
                'text' => 'agence',
                'th_class' => 'fit-width',
            ],
            'staff_count' => [
                'text' => 'personnel',
                'th_class' => 'fit-width',
            ],
            'client_count' => [
                'text' => 'clients',
                'th_class' => 'fit-width',
            ],
            'total_points' => [
                'text' => 'agence',
                'th_class' => 'fit-width',
            ],
        ];
        $data['charts']['agencies']['rows'] = DB::table('agencies')
            ->select(
                'agencies.name as agency_name',
                DB::raw('COUNT(DISTINCT staffs.id) as staff_count'),
                DB::raw('COUNT(DISTINCT clients.id) as client_count'),
                DB::raw('SUM(transactions.points) as total_points')
            )
            ->leftJoin('staffs', 'staffs.agency_id', '=', 'agencies.id')
            ->leftJoin('clients', 'clients.agency_id', '=', 'agencies.id')
            ->leftJoin('transactions', 'transactions.client_id', '=', 'clients.id')
            ->whereDate('transactions.created_at', '>', $date['dateStart'])
            ->whereDate('transactions.created_at', '<=', $date['dateEnd'])
            ->groupBy('agencies.name') // Updated to use correct column
            ->orderBy('total_points', 'desc')
            ->get();


        return view('pages.dashboard.statistics.statistics', compact('date', 'data'));
    }
}
