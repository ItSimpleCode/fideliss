<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $columns = ["Prénom", "Nom de famille", "Numéro de téléphone", "Sexe", "Email", "Date d'adhésion", "Cartes"];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'cards_number'];
        if (Auth::guard('admin')->check()) {
            $clients = Client::select('id', 'first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'active')
            ->orderBy('created_at','desc')
            ->get();
        } else if (Auth::guard('staff')->check()) {
            $clients = Client::select('id', 'first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'active')
                ->where('id_branch', Auth::guard('staff')->user()->id_branch)
                ->orderBy('created_at','desc')
                ->get();
        }


        $data = $clients->map(function ($client) {
            $client->cards_number = $client->clientCards()->count();
            return $client;
        });

        $table = 'clients';
        $btns = ['cards', 'desactive'];

        return view('pages.dashboard.clients.clients', compact('data', 'columns', 'fields', 'table', 'btns'));
    }

    public function showAddForm()
    {
        $branchs = Branch::where('active', 1)->get();
        return view('pages.dashboard.clients.add', compact('branchs'));
    }
    public function create(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date',
                'phone_number' => 'required',
                'gender' => 'required|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
            if (Auth::guard('admin')->check()) {
                $request->validate([
                    'id_branch' => 'required',
                ]);
            }
            $client = new Client;
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->gender = $request->gender;
            $client->address = $request->address;
            $client->email = $request->email;
            if (Auth::guard('admin')->check()) {
                $client->id_creator = Auth::guard('admin')->user()->id;
                $client->id_branch = $request->id_branch;
                $client->creator_type = 'admin';
            } else if (Auth::guard('staff')->check()) {
                $client->id_creator = Auth::guard('staff')->user()->id;
                $client->id_branch = Auth::guard('staff')->user()->id_branch;
                $client->creator_type = 'staff';
            }
            $client->save();


            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }


    public function showEditForm($id)
    {
        $client = Client::select('id', 'first_name', 'last_name', 'birth_date', 'phone_number', 'gender', 'address', 'email', 'password')
            ->where('id', $id)
            ->first();

        return view('pages.dashboard.clients.edit', compact('client'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date',
                'phone_number' => 'required|max:255',
                'gender' => 'required|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'active' => 'required',
            ]);

            $client = Client::find($id);
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->gender = $request->gender;
            $client->address = $request->address;
            $client->email = $request->email;
            $client->active = $request->active;
            $client->update();


            return redirect()->route('clients');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function changeStatus($id)
    {
        $client = Client::find($id);
        $client->active = !$client->active;
        $client->update();
        return redirect()->route('clients');
    }
}
