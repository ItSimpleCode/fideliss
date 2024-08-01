<?php

namespace App\Http\Controllers;

use App\Mail\forgetPasswordMail;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Staff;
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
        return view('layouts.dashboard.statistics');
    }


    //! --- Users traitement
    public function showAdmins()
    {
        //! --  old code
        // $columns = ['id' => '-', 'username' => 'name', 'phone_number' => 'phone number', 'gender' => 'gender', 'email' => 'email', 'created_at' => 'joining date'];
        // $data = Admin::select(array_keys($columns))
        //     ->orderBy('created_at')
        //     ->get();

        //! --  new code
        $columns = ['name', 'phone number', 'gender', 'email', 'joining date'];
        $fields = ['username', 'phone_number', 'gender', 'email', 'created_at'];
        $data = Admin::select('id', 'username', 'phone_number', 'gender', 'email', 'created_at')
            ->orderBy('created_at')
            ->get();

        $table = 'admins';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }


    public function showStaffs()
    {
        //! --  old code
        // $columns = ['id' => '-', 'username' => 'name', 'phone_number' => 'phone number', 'gender' => 'gender', 'email' => 'email', 'created_at' => 'joining date'];

        // $data = Staff::select(array_keys($columns))
        //     ->orderBy('staffs.created_at')
        //     ->get();
        // $table = 'staffs';

        //! --  new code
        $columns = ['name', 'phone number', 'gender', 'email', 'joining date'];
        $fields = ['username', 'phone_number', 'gender', 'email', 'created_at'];
        $data = Client::select('id', 'username', 'phone_number', 'gender', 'email', 'created_at')
            ->orderBy('created_at')
            ->get();
        $table = 'staffs';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }

    public function showClients()
    {
        //! --  old code
        //     $columns = ['id' => '-', 'username' => 'name', 'phone_number' => 'phone number', 'gender' => 'gender', 'email' => 'email', 'created_at' => 'joining date'];
        //     $data = Client::select(array_keys($columns))
        //         ->orderBy('created_at')
        //         ->get();
        //     $table = 'clients';
        //     return view('layouts.dashboard.table', compact('data', 'columns', 'table'));

        //! --  new code

        $columns = ['name', 'phone number', 'gender', 'email', 'joining date', 'cards'];
        $fields = ['username', 'phone_number', 'gender', 'email', 'created_at', 'cards_number'];
        $clients = Client::select('id', 'username', 'phone_number', 'gender', 'email', 'created_at')->get();

        $data = $clients->map(function ($client) {
            $client->cards_number = $client->clientCards()->count();
            return $client;
        });

        $table = 'clients';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }






    //juste for ading new admin with password hash
    // public function addAdmin()
    // {
    //     $admin = new Admin;
    //     $admin->fullname = 'admin';
    //     $admin->email = 'youssef@youssef.com';
    //     $admin->password =  Hash::make('adminadmin');
    //     $admin->save();

    //     return redirect()->route('login.show');
    // }
}
