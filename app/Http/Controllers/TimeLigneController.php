<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Agency;
use App\Models\Client;
use App\Models\ClientCards;
use App\Models\Staff;
use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TimeLigneController extends Controller
{
    public function index(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'd' => 'nullable|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $date = $r->has('d') && !empty($r->input('d'))
            ? Carbon::parse($r->input('d'))->format('Y-m')
            : Carbon::now()->format('Y-m');

        $startDate = Carbon::parse($date)->startOfMonth();
        $endDate = Carbon::parse($date)->endOfMonth();

        $tables = [
            'agencies' => Agency::class,
            'clients' => Client::class,
            'staffs' => Staff::class,
            'cards' => Card::class,
            'transactions' => Transaction::class,
        ];

        $data['tables'] = array_map(function ($modelClass) use ($startDate, $endDate) {
            return $modelClass::select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS count'))
                ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy(DB::raw('DATE(created_at)'))
                ->get()
                ->pluck('count', 'date')
                ->toArray();
        }, $tables);

        $data['date'] = [
            'now' => Carbon::now()->format('Y-m'),
            'target' => $date,
            'previous' => Carbon::parse($date)->subMonth()->format('Y-m'),
            'next' => Carbon::parse($date)->addMonth()->format('Y-m'),
        ];


        return view('pages.dashboard.timeline.timeLine', compact('data'));
    }

    public function show(Request $r, $table)
    {
        $validator = Validator::make($r->all(), [
            'd' => 'nullable|date_format:Y-m-d',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $date = $r->has('d') && !empty($r->input('d'))
            ? Carbon::parse($r->input('d'))->format('Y-m-d')
            : Carbon::now()->format('Y-m-d');

//        $startDate = Carbon::parse($date)->startOfMonth();
//        $endDate = Carbon::parse($date)->endOfMonth();

        $tables = [
            'agencies' => [
                'module' => Agency::class,
                'title' => 'test',
                'columns' => [
                    'name' => [
                        'text' => 'Nom',
                        'th_class' => 'fit-width',
                    ],
                    'address' => [
                        'text' => 'Adresse',
                        'th_class' => '',
                    ],
                ],
            ],
            'clients' => [
                'module' => Client::class,
                'title' => 'test',
                'columns' => [
                    'first_name' => ['text' => 'Prénom', 'th_class' => ''],
                    'last_name' => ['text' => 'Nom', 'th_class' => ''],
                    'cin' => ['text' => 'cin', 'th_class' => ''],
                    'phone_number' => ['text' => 'N.téléphone', 'th_class' => ''],
                    'gender' => ['text' => 'Sexe', 'th_class' => ''],
                    'optional_name' => ['text' => 'nom facultatif', 'th_class' => ''],
                ],
            ],
            'staffs' => [
                'module' => Staff::class,
                'title' => 'test',
                'columns' => [
                    "first_name" => [
                        'text' => 'Prénom',
                        'th_class' => '',
                    ],
                    "last_name" => [
                        'text' => 'Nom',
                        'th_class' => '',
                    ],
                    "phone_number" => [
                        'text' => 'N.téléphone',
                        'th_class' => 'fit-width',
                    ],
                    "gender" => [
                        'text' => 'Sexe',
                        'th_class' => 'fit-width',
                    ],
                    "email" => [
                        'text' => 'email',
                        'th_class' => '',
                    ],
                    "active" => [
                        'text' => 'statut',
                        'th_class' => 'fit-width',
                    ]
                ],
            ],
            'cards' => [
                'module' => Card::class,
                'title' => 'test',
                'columns' => [
                    'name' => [
                        'text' => 'Nom',
                        'th_class' => '',
                    ],
                    'cost' => [
                        'text' => 'Coût',
                        'th_class' => '',
                    ],
                    'period' => [
                        'text' => 'Période (jours)',
                        'th_class' => '',
                    ],
                    'active' => [
                        'text' => 'statut',
                        'th_class' => '',
                    ],
                ],
            ],
            'transactions' => [
                'module' => Transaction::class,
                'title' => 'test',
                'columns' => [
                    'id' => [],
                    'staff_id' => [],
                    'client_id' => [],
                    'actor' => [
                        'text' => 'actor',
                        'th_class' => 'fit-width'
                    ],
                    "points" => [
                        'text' => 'points',
                        'th_class' => 'fit-width'
                    ],
                    'description' => [
                        'text' => 'description',
                        'th_class' => ''

                    ]
                ],
            ],
        ];


        if (!array_key_exists($table, $tables)) return redirect()->route('timeLine');

        $data['table'] = $table;
        $data['columns'] = $tables[$table]['columns'];

        if ($table === 'transactions') {
            $data['rows'] = $tables[$table]['module']::select([
                ...array_map(fn($val) => "transactions.$val", array_keys($data['columns'])),
                'clients.first_name as client_first_name',
                'clients.last_name as client_last_name',
                'staffs.first_name as staff_first_name',
                'staffs.last_name as staff_last_name',
                'agencies.name as agency_name'
            ])
                ->leftJoin('clients', 'clients.id', '=', 'transactions.client_id')
                ->leftJoin('staffs', 'staffs.id', '=', 'transactions.staff_id')
                ->leftJoin('agencies', 'agencies.id', '=', 'staffs.agency_id')
                ->whereDate('transactions.created_at', $date)
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

                $confirmed = json_decode($row['description'], true)['confirmed'];

                $row['description'] = $confirmed['message'] ?? '';

                unset(
                    $row['client_first_name'],
                    $row['client_last_name'],
                    $row['staff_first_name'],
                    $row['staff_last_name']
                );

            }
        } else {
            $data['rows'] = $tables[$table]['module']::select(array_keys($data['columns']))
                ->whereDate('created_at', $date)
                ->get();
        }

        $data['date'] = [
            'now' => Carbon::now()->format('Y-m-d'),
            'target' => $date,
            'targetMonth' => Carbon::parse($date)->format('Y-m'),
            'thisMonth' => Carbon::now()->format('Y-m'),
            'previousDay' => Carbon::parse($date)->subDay()->format('Y-m-d'),
            'previousMonth' => Carbon::parse($date)->subMonth()->format('Y-m'),
            'nextDay' => Carbon::parse($date)->subDay()->format('Y-m-d'),
            'nextMonth' => Carbon::parse($date)->addMonth()->format('Y-m'),
        ];


        return view('pages.dashboard.timeline.show', compact('data'));
    }
}
