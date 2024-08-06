<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'active' => $staff->active
            ];
        });
        $table = 'staffs';
        return view('pages.dashboard.staffs.staffs', compact('data', 'columns', 'fields', 'table'));
    }

    public function showAddForm()
    {
        $branches = Branch::select('id', 'name')->get();
        return view('pages.dashboard.staffs.add', compact('branches'));
    }


    public function create(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date',
                'phone_number' => 'required|max:255',
                'gender' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:8|max:255',
                'id_branch' => 'required',
            ]);

            $client = new Staff;
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->gender = $request->gender;
            $client->email = $request->email;
            $client->password = $request->password;
            $client->id_creator = Auth::guard('admin')->user()->id;
            $client->id_branch = $request->id_branch;
            $client->save();


            return redirect()->route('staffs');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function changeStatus($id)
    {
        $staff = Staff::find($id);
        $staff->active = !$staff->active;
        $staff->update();
        return redirect()->route('staffs');
    }
}
