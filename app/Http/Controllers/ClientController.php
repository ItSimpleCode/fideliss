<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $columns = ['First name', 'Last name', 'phone number', 'gender', 'email', 'joining date', 'cards'];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'cards_number'];
        $clients = Client::select('id', 'first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at')->get();

        $data = $clients->map(function ($client) {
            $client->cards_number = $client->clientCards()->count();
            return $client;
        });

        $table = 'clients';
        return view('layouts.dashboard.clients.clients', compact('data', 'columns', 'fields', 'table'));
    }

    public function showAddForm()
    {
        return view('layouts.dashboard.clients.add');
    }
    public function create(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date|max:255',
                'phone_number' => 'required|max:255',
                'gender' => 'required|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            $client = new Client;
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->gender = $request->gender;
            $client->address = $request->address;
            $client->email = $request->email;
            $client->password = '123456789';
            if (Auth::guard('admin')->check()) {
                $client->id_creator = Auth::guard('admin')->user()->id;
                $client->creator_type = 'admin';
            } else if (Auth::guard('staff')->check()) {
                $client->id_creator = Auth::guard('staff')->user()->id;
                $client->creator_type = 'staff';
            }
            $client->save();


            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }


    public function showEditeForm($id)
    {
        $client = Client::select('id', 'first_name', 'last_name', 'birth_date', 'phone_number', 'gender', 'address', 'email', 'password')
            ->where('id', $id)
            ->first();

        return view('layouts.dashboard.clients.edite', compact('client'));
    }

    public function edite(Request $request, $id)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date|max:255',
                'phone_number' => 'required|max:255',
                'gender' => 'required|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            $client = Client::find($id);
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->gender = $request->gender;
            $client->address = $request->address;
            $client->email = $request->email;
            $client->password = '123456789';
            if (Auth::guard('admin')->check()) {
                $client->id_creator = Auth::guard('admin')->user()->id;
                $client->creator_type = 'admin';
            } else if (Auth::guard('staff')->check()) {
                $client->id_creator = Auth::guard('staff')->user()->id;
                $client->creator_type = 'staff';
            }
            $client->update();


            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }
}
