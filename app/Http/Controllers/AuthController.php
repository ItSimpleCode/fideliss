<?php

namespace App\Http\Controllers;

use App\Mail\forgetPasswordMail;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Staff;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //! --- login traitement
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            // $request->validate([
            //     'email' => 'required|email|max:255',
            //     'password' => 'required|string|min:8|max:255',
            // ]);

            $admin = Admin::where(['email' => $request->email, 'password' => $request->password])->first();
            // if ($admin && Hash::check($request->password, $admin->password)) {
            if ($admin) {
                Auth::guard('admin')->login($admin);
                return redirect()->route('statistics');
            } else {
                $staff = Staff::where(['email' => $request->email, 'password' => $request->password])->first();
                if ($staff) {
                    Auth::guard('staff')->login($staff);
                    return redirect()->route('dashboard');
                }
            }

            return back()->withErrors(['error' => 'Email or password are incorrect']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'something uncorrected']);
        }
    }


    //! --- forget passsord traitement
    public function showForgetPassword()
    {
        return view('forgetPassword');
    }
    public function SendPasswordInMail(Request $request)
    {
        $admin = Admin::where(['email' => $request->email])->first();
        $password = $admin->password;
        if ($admin) {
            Mail::to($request->email)->send(new forgetPasswordMail($password));
            return view('login');
        }
        return back()->withErrors(['error' => 'Email not found'])->withInput();
    }





    //! --- logout traitement
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('staff')->check()) {
            Auth::guard('staff')->logout();
        }

        return redirect()->route('login.show');
    }

    //! --- statistics traitement
    public function showStatistics()
    {
        // $transactions = Transaction::with([
        //     'clientCards' => ['cards']
        // ])
        //     ->orderBy('created_at')
        //     ->get();
        //     $data = 

        // return response()->json($transactions);
        return view('layouts.dashboard.statistics', ['transactions']);
    }


    //! --- Users traitement
    public function showAdmins()
    {
        $columns = ['First name', 'Last name', 'phone number', 'gender', 'email', 'joining date'];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at'];
        $data = Admin::select('id', 'first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at')
            ->orderBy('created_at')
            ->get();

        $table = 'Admins';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }


    public function showStaffs()
    {
        $columns = ['First name', 'Last name', 'phone number', 'gender', 'email', 'joining date', 'creator', 'branch'];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'creator', 'branch'];
        $staffs = Staff::with(['admins', 'branchs'])
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
                'creator' => $staff->admins ? $staff->admins->username : 'N/A',
                'branch' => $staff->branchs ? $staff->branchs->name : 'N/A',
            ];
        });
        $table = 'Staffs';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }

    public function showClients()
    {
        $columns = ['First name', 'Last name', 'phone number', 'gender', 'email', 'joining date', 'cards'];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'cards_number'];
        $clients = Client::select('id', 'first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at')->get();

        $data = $clients->map(function ($client) {
            $client->cards_number = $client->clientCards()->count();
            return $client;
        });

        $table = 'Clients';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }
}
