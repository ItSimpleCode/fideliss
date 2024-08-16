<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        $columns = ["Prénom", "Nom", "N.téléphone", "Sexe", "Email", "D.naissance", "Créateur", "branche"];
        $fields = ['first_name', 'last_name', 'phone_number', 'gender', 'email', 'created_at', 'creator', 'branch'];
        $staffs = Staff::with(['admins', 'branches'])
            ->orderBy('created_at', 'desc')
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
        $branches = Branch::select('id', 'name')
            ->where(['active' => 1])
            ->get();
        return view('pages.dashboard.staffs.add', compact('branches'));
    }


    public function create(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                // 'birth_date' => 'required|date',
                'phone_number' => 'required',
                'gender' => 'required',
                'email' => 'required|email|max:255',
                'password' => 'required|min:8|max:255',
                'id_branch' => 'required',
            ], [
                'first_name.required' => 'Le prénom est requis.',
                'first_name.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
                'last_name.required' => 'Le nom de famille est requis.',
                'last_name.max' => 'Le nom de famille ne peut pas dépasser 255 caractères.',
                // 'birth_date.required' => 'La date de naissance est requis.',
                'phone_number.required' => 'Le numéro de téléphone est requis.',
                'gender.required' => 'Le genre est requis.',
                'email.required' => 'L\'adresse email est requise.',
                'email.email' => 'L\'adresse email doit être valide.',
                'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',
                'password.required' => 'Le mot de passe est requis.',
                'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
                'password.max' => 'Le mot de passe ne peut pas dépasser 255 caractères.',
                'id_branch.required' => 'La branche est requise.',
            ]);


            $staff = new Staff;
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->birth_date = '1999-12-31';
            // $staff->birth_date = $request->birth_date;
            $staff->phone_number = $request->phone_number;
            $staff->gender = $request->gender;
            if (
                Admin::where('email', $staff->email)->exists() ||
                Staff::where('email', $staff->email)->exists() ||
                Client::where('email', $staff->email)->exists()
            ) {
                return back()->withErrors(['error' =>  'ce mail est deja utilisé']);
            }
            $staff->email = $request->email;
            $staff->password = $request->password;
            $staff->id_creator = Auth::guard('admin')->user()->id;
            $staff->id_branch = $request->id_branch;
            $staff->save();


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

    public function showEditForm($id)
    {
        $branches = Branch::select('id', 'name')
            ->where('active', 1)
            ->get();

        $staff = Staff::find($id);
        return view('pages.dashboard.staffs.edit', compact('staff', 'branches'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date',
                'phone_number' => 'required',
                'gender' => 'required',
                'email' => 'required|email|max:255',
                'password' => 'required|min:8|max:255',
                'id_branch' => 'required',
            ], [
                'first_name.required' => 'Le prénom est requis.',
                'first_name.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
                'last_name.required' => 'Le nom de famille est requis.',
                'last_name.max' => 'Le nom de famille ne peut pas dépasser 255 caractères.',
                'birth_date.required' => 'La date de naissance est requis.',
                'phone_number.required' => 'Le numéro de téléphone est requis.',
                'gender.required' => 'Le genre est requis.',
                'email.required' => 'L\'adresse email est requise.',
                'email.email' => 'L\'adresse email doit être valide.',
                'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',
                'password.required' => 'Le mot de passe est requis.',
                'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
                'password.max' => 'Le mot de passe ne peut pas dépasser 255 caractères.',
                'id_branch.required' => 'La branche est requise.',
            ]);



            $staff = Staff::find($id);
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->birth_date = $request->birth_date;
            $staff->phone_number = $request->phone_number;
            $staff->gender = $request->gender;
            $currentEmail = $staff->email;
            $emailExists = Admin::where('email', $request->email)->exists() ||
                Staff::where('email', $request->email)->where('email', '!=', $currentEmail)->exists() ||
                Client::where('email', $request->email)->exists();

            if ($emailExists) {
                return back()->withErrors(['error' =>  'ce mail est deja utilisé']);
            }
            $staff->email = $request->email;
            $staff->password = $request->password;
            $staff->id_branch = $request->id_branch;
            $staff->update();

            return redirect()->route('staffs');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }
}
