<?php

namespace App\Http\Controllers;

use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $data['columns'] = [
            'id' => [],
            'first_name' => [
                'text' => 'Prénom',
                'th_class' => '',
            ],
            'last_name' => [
                'text' => 'Nom',
                'th_class' => '',
            ],
            'gender' => [
                'text' => 'Sexe',
                'th_class' => '',
            ],
            'phone_number' => [
                'text' => 'N.téléphone',
                'th_class' => '',
            ],
            'email' => [
                'text' => 'Email',
                'th_class' => '',
            ]
        ];

        $data['rows'] = Admin::select(array_keys($data['columns']))
            ->orderBy('created_at')
            ->get();

        return view('pages.dashboard.admins.admins', compact('data'));
    }
}
