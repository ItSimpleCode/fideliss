<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $columns = ['First name', 'Last name', 'phone number', 'gender', 'email', 'joining date', 'creator', 'branch'];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'creator', 'branch'];
        $staffs = Staff::with(['admins', 'branches'])
            ->orderBy('created_at')
            ->get();

        $data = $staffs->map(function ($staff) {
            return [
                'id' => $staff->id,
                'first_name' => $staff->first_name,
                'last_name' => $staff->last_name,
                'phone_number' => $staff->phone_number,
                'gender' => $staff->gender,
                'email' => $staff->email,
                'created_at' => $staff->created_at,
                'creator' => $staff->admins ? $staff->admins->first_name . ' ' .  $staff->admins->last_name : 'N/A',
                'branch' => $staff->branches ? $staff->branches->name : 'N/A',
            ];
        });
        $table = 'staffs';
        return view('layouts.dashboard.staffs.staffs', compact('data', 'columns', 'fields', 'table'));
    }
}
