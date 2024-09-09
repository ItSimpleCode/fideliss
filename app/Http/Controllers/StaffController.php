<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {

        $data['columns'] = [
            "id" => [],
            "first_name" => [
                'text' => 'Prénom',
                'th_class' => '',
            ],
            "last_name" => [
                'text' => 'Nom',
                'th_class' => '',
            ],
            "phone_number" => [
                'text' => 'N.téléphone',
                'th_class' => 'fit-width',
            ],
            "gender" => [
                'text' => 'Sexe',
                'th_class' => 'fit-width',
            ],
            "email" => [
                'text' => 'email',
                'th_class' => '',
            ],
            "active" => [],
            "agency_name" => [
                'text' => 'agence',
                'th_class' => 'fit-width',
            ],
            "admin_name" => [
                'text' => 'c.administrateur',
                'th_class' => 'fit-width',
            ],
        ];
        $data['rows'] = Staff::with(['admin', 'agency'])
            ->orderBy('staffs.created_at', 'desc')
            ->get()
            ->map(function ($staff) {
                $staff->agency_name = $staff->agency ? $staff->agency->name : null;
                $staff->admin_name = $staff->admin ? $staff->admin->first_name . ' ' . $staff->admin->last_name : null;

                unset(
                    $staff->agency,
                    $staff->agency_id,
                    $staff->admin,
                    $staff->creator_admin_id,
                    $staff->created_at,
                    $staff->updated_at,
                    $staff->birth_date,
                    $staff->password,
                    $staff->image
                );
                return $staff;
            });
        return view('pages.dashboard.staffs.staffs', compact('data'));
    }

    public function create()
    {
        $data['agencies'] = Agency::select('id', 'name')
            ->where(['active' => 1])
            ->get();
        return view('pages.dashboard.staffs.add', compact('data'));
    }


    public function insert(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date',
                'phone_number' => 'required',
                'gender' => 'required',
                'password' => 'required|min:8|max:255',
                'id_branch' => 'required',
            ], [
                'first_name.required' => 'Le prénom est requis.',
                'first_name.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
                'last_name.required' => 'Le nom de famille est requis.',
                'last_name.max' => 'Le nom de famille ne peut pas dépasser 255 caractères.',
                'birth_date.required' => 'La date de naissance est requis.',
                'birth_date.date' => 'La date de naissance doit être une date valide.',
                'phone_number.required' => 'Le numéro de téléphone est requis.',
                'gender.required' => 'Le genre est requis.',
                'password.required' => 'Le mot de passe est requis.',
                'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
                'password.max' => 'Le mot de passe ne peut pas dépasser 255 caractères.',
                'id_branch.required' => 'La branche est requise.',
            ]);

            $request->validate([
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        $emailExists = DB::table('staffs')->where('email', $value)->exists() ||
                            DB::table('admins')->where('email', $value)->exists() ||
                            DB::table('clients')->where('email', $value)->exists();

                        if ($emailExists) {
                            $fail('Cet email est déjà utilisé.');
                        }
                    },
                ],
            ], [
                'email.required' => 'L\'adresse email est requise.',
                'email.email' => 'L\'adresse email doit être valide.',
                'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',
            ]);


            $staff = new Staff;
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->birth_date = $request->birth_date;
            $staff->phone_number = $request->phone_number;
            $staff->gender = $request->gender;
            $staff->email = $request->email;
            $staff->password = $request->password;
            $staff->id_creator = Auth::guard('admin')->user()->id;
            $staff->id_branch = $request->id_branch;
            $staff->save();


            return redirect()->route('staffs');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['agencies'] = Agency::select('id', 'name')
            ->where('active', 1)
            ->get();

        $data['row'] = Staff::find($id);
        $data['row']['agency_name'] = $data['row']->agency_id ? Agency::find($data['row']->agency_id)->name : null;

        return view('pages.dashboard.staffs.edit', compact('data'));
    }

    public function update(Request $request, $id)
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
                return back()->withErrors(['error' => 'ce mail est deja utilisé']);
            }
            $staff->email = $request->email;
            $staff->password = $request->password;
            $staff->id_branch = $request->id_branch;
            $staff->update();

            return redirect()->route('staffs');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
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
