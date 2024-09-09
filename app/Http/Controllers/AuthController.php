<?php

namespace App\Http\Controllers;

use App\Mail\forgetPasswordMail;
use App\Mail\LoginMessageMail;
use App\Models\Admin;
use App\Models\Staff;
use Carbon\Carbon;
use Exception;
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

            $user_login = ['email' => strtolower($request->email), 'password' => strtolower($request->password)];

            $data = [
                'guard' => 'admin',
                'row' => Admin::where($user_login)->first(),
                'route' => 'statistics'
            ];
            if (!$data['row']) $data = [
                'guard' => 'staff',
                'row' => Staff::where($user_login)->first(),
                'route' => 'pending_transactions'
            ];

            if ($data['guard'] == 'admin' || ($data['guard'] == 'staff' && $data['row']->active)) {
                Auth::guard($data['guard'])->login($data['row']);
                $user = "{$data['row']->first_name} {$data['row']->last_name}";
                $currentDateTime = Carbon::now()->format('Y-m-d H:i');
                // Mail::to($data['row']->email)->send(new LoginMessageMail($fullName, $currentDateTime));
                return redirect()->route($data['route']);
            } else redirect()->route('login.show')->withErrors(['error' => 'email ou mot de passe incorrect']);

        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Quelque chose ne tourne pas rond']);
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

}
