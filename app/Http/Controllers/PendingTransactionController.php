<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\PendingTransaction;
use App\Models\Staff;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PendingTransactionController extends Controller
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
            'staffs.last_name as staff_last_name'
        ];

        if (Auth::guard('admin')->check()) array_push($selection, 'agencies.name as agency_name');

        $quary = PendingTransaction::select($selection)
            ->leftJoin('clients', 'clients.id', '=', 'pending_transactions.client_id')
            ->leftJoin('staffs', 'staffs.id', '=', 'pending_transactions.staff_id')
            ->leftJoin('agencies', 'agencies.id', '=', 'staffs.agency_id');

        if (Auth::guard('admin')->check()) {
            $quary->where('rejected', false)->orWhere('accepted', true);
        }

        $data['rows'] = $quary->get();

        $data['columns'] = array_merge(
            Auth::guard('admin')->check() ?
                [
                    'agency_name' => ['text' => 'agence', 'th_class' => 'fit-width'],
                    'staff_name' => ['text' => 'personnel', 'th_class' => 'fit-width'],
                    'client_name' => ['text' => 'client', 'th_class' => 'fit-width']
                ] :
                [
                    'staff_name' => ['text' => 'personnel', 'th_class' => 'fit-width'],
                    'client_name' => ['text' => 'client', 'th_class' => 'fit-width'],
                    'status' => ['text' => 'statut', 'th_class' => 'fit-width']
                ],
            $data['columns']
        );


        foreach ($data['rows'] as $row) {
            $row['client_name'] = $row['client_first_name'] . ' ' . $row['client_last_name'];
            $row['staff_name'] = $row['staff_first_name'] . ' ' . $row['staff_last_name'];

            $accepted = $row['accepted'];
            $rejected = $row['rejected'];

            $row['status'] =
                $accepted && $rejected
                    ? '-'
                    : (
                $accepted && !$rejected
                    ? 'accepted'
                    : (!$accepted && $rejected ? 'rejected' : 'pending')
                );

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

        return view('pages.dashboard.demandes.demandes', compact('data'));
    }


    public function edit($id)
    {
        try {
            if (!is_numeric($id)) return redirect()->route('clients')->withErrors(['error' => '']);

            $data = [
                'pending_transactions' => [
                    'columns' => [
                        'id',
                        'staff_id',
                        'client_id',
                        'accepted',
                        'points',
                        'description',
                    ],
                ],
                'clients' => [
                    'columns' => [
                        'clients.id',
                        'clients.first_name',
                        'clients.last_name',
                        'clients.cin',
                        'clients.birth_date',
                        'clients.phone_number',
                        'clients.gender',
                        'clients.address',
                        'clients.email',
                        'clients.optional_name',
                        'clients.wallet',
                        'clients.card_id',
                        'cards.name as card_name',
                        'clients.status',
                        'clients.agency_id',
                        'agencies.name as agency_name'
                    ]
                ],
                'staffs' => [
                    'columns' => [
                        "staffs.id",
                        "staffs.first_name",
                        "staffs.last_name",
                        "staffs.phone_number",
                        "staffs.gender",
                        "staffs.email",
                        "staffs.active",
                        "staffs.agency_id",
                        "agencies.name as agency_name",
                    ]
                ]
            ];

            $data['pending_transactions']['row'] = PendingTransaction::select($data['pending_transactions']['columns'])
                ->where('id', $id)
                ->first();

            if (!$data['pending_transactions']['row']) return redirect()->route('pending_transactions')->withErrors(['error' => '']);
            if (!Auth::guard('admin')->check() && $data['pending_transactions']['row']->accepted) return redirect()->route('pending_transactions')->withErrors(['error' => '']);
            if (!$data['pending_transactions']['row']->client_id) return redirect()->route('pending_transactions')->withErrors(['error' => '']);

            $data['pending_transactions']['row']['description'] = json_decode($data['pending_transactions']['row']->description, true)['history'];

            // Filter items where sender is 'staff'
            $ids = [
                'admin' => [
                    'table' => Admin::class,
                    'ids' => [],
                ],
                'staff' => [
                    'table' => Staff::class,
                    'ids' => [],
                ]
            ];

//            return $data;

            foreach ($data['pending_transactions']['row']['description'] as $arr) {
                if (!empty($ids[$arr['sender']])) $ids[$arr['sender']]['ids'][] = $arr['sender_id'];
            }

            foreach ($ids as $guard => $arr) {
                if (!empty($arr['ids'])) {
                    $results = $arr['table']::select('id', 'first_name', 'last_name')
                        ->whereIn('id', $arr['ids'])
                        ->get();

                    foreach ($results as $staff) {
                        $data[$guard][$staff->id] = "{$staff->first_name} {$staff->last_name}";
                    }
                } else  $data[$guard] = [];
            }

            $data['clients']['row'] = Client::select(...$data['clients']['columns'])
                ->leftJoin('cards', 'cards.id', 'clients.card_id')
                ->leftJoin('agencies', 'agencies.id', 'clients.agency_id')
                ->where('clients.id', $data['pending_transactions']['row']->client_id)
                ->first();

            $data['staffs']['row'] = Staff::select(...$data['staffs']['columns'])
                ->leftJoin('agencies', 'agencies.id', 'staffs.agency_id')
                ->where('staffs.id', $data['pending_transactions']['row']->staff_id)
                ->first();

            return view('pages.dashboard.demandes.edit', compact('data'));
        } catch (Exception $e) {
            return redirect()->route('clients')->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'points' => 'required|numeric|not_in:0',
                'message' => 'required|string|max:255',
            ], [
                'points.required' => 'The points field is required.',
                'points.numeric' => 'The points must be a number.',
                'points.not_in' => 'The points cannot be zero.',
                'message.required' => 'The message field is required.',
                'message.string' => 'The message must be a string.',
                'message.max' => 'The message may not be greater than 255 characters.',
            ]);

            // Find the PendingTransaction record
            $pendingTransaction = PendingTransaction::find($id);

            if (!$pendingTransaction) return back()->withErrors(['error' => '']);
            if ($pendingTransaction->accepted) return back()->withErrors(['error' => '']);

            // Find the associated client
            $client = Client::select('wallet')->where('id', $pendingTransaction->client_id)->first();

            if (!$client) {
                return back()->withErrors(['error' => 'Client not found.']);
            }

            // Decode the JSON description field
            $description = json_decode($pendingTransaction->description, true) ?? [];

            // Ensure history is an array
            $description['history'] = $description['history'] ?? [];

            // Add or update the history entry
            $description['history'][Carbon::now()->toDateTimeString()] = [
                'wallet' => $client->wallet,
                'add' => $request->points,
                'sender' => Auth::guard('admin')->check() ? 'admin' : (Auth::guard('staff')->check() ? 'staff' : null),
                'sender_id' => Auth::guard('admin')->id() ?? Auth::guard('staff')->id(),
                'message' => $request->message,
            ];

            // Update the PendingTransaction record
            $pendingTransaction->update([
                'points' => $request->points,
                'description' => json_encode($description),
                'rejected' => false,
            ]);

            return redirect()->route('pending_transactions')->with('success', 'PendingTransaction updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function valid($id)
    {
        $pendingTransactionRow = PendingTransaction::find($id);

        if (!$pendingTransactionRow) return redirect()->Route('pending_transactions')->withErrors(['error' => '']);
        if ($pendingTransactionRow->accepted) return redirect()->Route('pending_transactions')->withErrors(['error' => '']);


        $createTransaction = Transaction::create([
            'actor' => 'staff',
            'admin_id' => Auth::guard('admin')->id(),
            'staff_id' => $pendingTransactionRow->staff_id,
            'client_id' => $pendingTransactionRow->client_id,
            'points' => $pendingTransactionRow->points,
            'description' => $pendingTransactionRow->description,
        ]);

        if (!$createTransaction) return redirect()->Route('pending_transactions')->withErrors(['error' => '']);

        $clientRow = Client::find($pendingTransactionRow->client_id);

        $updateClientRow = $clientRow->status === 'active' && $clientRow->update([
                'wallet' => (float)$clientRow->wallet + (float)$pendingTransactionRow->points,
            ]);

        if (!$updateClientRow) {
            $createTransaction->delete();
            return redirect()->Route('pending_transactions')->withErrors(['error' => '']);
        }

        $pendingTransactionRow->update(['accepted' => true]);

        return redirect()->route('pending_transactions');
    }

    public function invalid($id)
    {
        $PendingTransaction = PendingTransaction::find($id)->update(['rejected' => true]);

        return redirect()->route('pending_transactions');
    }

}
