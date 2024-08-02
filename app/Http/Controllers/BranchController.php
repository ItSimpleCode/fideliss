<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $columns = ['name', 'address'];
        $fields = ['name', 'address'];
        $data = Branch::select($fields)
            ->orderBy('created_at')
            ->get();
        $table = 'Branchs';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }
}
