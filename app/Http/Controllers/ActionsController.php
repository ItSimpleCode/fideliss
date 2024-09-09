<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use App\Models\PendingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionsController extends Controller
{
    public function index()
    {
        $data['columns'] = [
            'id' => [],
            'staff_id' => [],
            'client_id' => [],
            'accepted' => [],
            'rejected' => [],
            "points" => [
                'text' => 'points',
                'th_class' => 'fit-width'
            ],
            'description' => [
                'text' => 'description',
                'th_class' => ''

            ]
        ];

        $selection = [
            ...array_map(fn($val) => "pending_transactions.$val", array_keys($data['columns'])),
            'clients.first_name as client_first_name',
            'clients.last_name as client_last_name',
            'staffs.first_name as staff_first_name',
            'staffs.last_name as staff_last_name',
            'agencies.name as agency_name',
        ];

        $data['rows'] = PendingTransaction::select($selection)
            ->leftJoin('clients', 'clients.id', '=', 'pending_transactions.client_id')
            ->leftJoin('staffs', 'staffs.id', '=', 'pending_transactions.staff_id')
            ->leftJoin('agencies', 'agencies.id', '=', 'staffs.agency_id')
            ->where([
                ['accepted', 'false'],
                ['rejected', 'false'],
            ])
            ->get();


        $data['columns'] = array_merge(
            [
                'agency_name' => ['text' => 'agence', 'th_class' => 'fit-width'],
                'staff_name' => ['text' => 'personnel', 'th_class' => 'fit-width'],
                'client_name' => ['text' => 'client', 'th_class' => 'fit-width']
            ],
            $data['columns']
        );


        foreach ($data['rows'] as $row) {
            $row['client_name'] = $row['client_first_name'] . ' ' . $row['client_last_name'];
            $row['staff_name'] = $row['staff_first_name'] . ' ' . $row['staff_last_name'];

            $history = json_decode($row['description'], true)['history'];
            ksort($history);

            $row['description'] = end($history)['message'];

            unset(
                $row['client_first_name'],
                $row['client_last_name'],
                $row['staff_first_name'],
                $row['staff_last_name']
            );
        }

        return view('pages.dashboard.actions.actions', compact('data'));
    }
    
}
