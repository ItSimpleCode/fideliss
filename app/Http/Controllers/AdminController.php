<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $columns = ["Prénom", "Nom", "N.téléphone", "Sexe", "Email", "D.naissance"];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at'];
        $data = Admin::select('id', 'first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at')
            ->orderBy('created_at')
            ->get();

        $table = 'admins';
        return view('pages.dashboard.admins.admins', compact('data', 'columns', 'fields', 'table'));
    }
}
