<?php

namespace App\Http\Controllers;

use App\Mail\forgetPasswordMail;
use App\Mail\LoginMessageMail;
use App\Models\Admin;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stevebauman\Location\Facades\Location;

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
                $fullName = $admin['first_name'] . ' ' . $admin['last_name'];
                $currentDateTime = Carbon::now()->format('Y-m-d H:i');
                Mail::to($request->email)->send(new LoginMessageMail($fullName, $currentDateTime));
                return redirect()->route('statistics');
            } else {
                $staff = Staff::where(['email' => $request->email, 'password' => $request->password])->first();
                if ($staff) {
                    Auth::guard('staff')->login($staff);
                    $fullName = $staff['first_name'] . ' ' . $staff['last_name'];
                    $currentDateTime = Carbon::now()->format('Y-m-d H:i');
                    Mail::to($request->email)->send(new LoginMessageMail($fullName, $currentDateTime));
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
        return view('pages.dashboard.statistics.statistics', ['transactions']);
    }
}
