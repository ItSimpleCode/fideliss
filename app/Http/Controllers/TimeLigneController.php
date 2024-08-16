<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Card;
use App\Models\Client;
use App\Models\Staff;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeLigneController extends Controller
{
    public function index()
    {
        $branches = Branch::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'))->get();
        $clients = Client::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'))->get();
        $staffs = Staff::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'))->get();
        $cards = Card::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'))->get();
        $transactions = Transaction::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'))->get();


        $data = [
            'branches' => $branches,
            'clients' => $clients,
            'staffs' => $staffs,
            'cards' => $cards,
            'transactions' => $transactions,
        ];

        return view('pages.dashboard.timeline.timeLine', compact('data'));
    }
}
