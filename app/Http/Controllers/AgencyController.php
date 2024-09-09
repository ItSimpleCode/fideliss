<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Client;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $data['columns'] = [
            'id' => [],
            'name' => [
                'text' => 'Nom',
                'th_class' => 'fit-width',
            ],
            'address' => [
                'text' => 'Adresse',
                'th_class' => '',
            ],
            'active' => []
        ];

        $data['rows'] = Agency::select(array_keys($data['columns']))
            ->withCount(['staffs'])
            ->orderBy('created_at', 'desc')
            ->get();

        $data['columns']['staffs_count'] = [
            'text' => 'personnel',
            'th_class' => 'fit-width',
        ];

        return view('pages.dashboard.agencies.agencies', compact('data'));
    }

    public function create()
    {
        return view('pages.dashboard.agencies.add');
    }

    public function insert(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|max:255',
                    'address' => 'required|max:255',
                ]
            // ,[
            //     'name.required' => 'Le nom de la branche est requis.',
            //     'name.max' => 'Le nom de la branche ne peut pas dépasser 255 caractères.',
            //     'address.required' => 'L\'adresse de la branche est requise.',
            //     'address.max' => 'L\'adresse de la branche ne peut pas dépasser 255 caractères.',
            // ]
            );

            $agency = new Agency;
            $agency->name = strtolower($request->name);
            $agency->address = strtolower($request->address);
            $agency->save();

            return Redirect()->route('agencies');
        } catch (Exception $e) {
            return back();
            // return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $agency = Agency::select('id', 'name', 'address')
            ->where('id', $id)
            ->first();

        return view('pages.dashboard.agencies.edit', compact('agency'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|max:255',
                    'address' => 'required|max:255',
                ],
                [
                    'name.required' => 'Le nom de la branche est requis.',
                    'name.max' => 'Le nom de la branche ne peut pas dépasser 255 caractères.',
                    'address.required' => 'L\'adresse de la branche est requise.',
                    'address.max' => 'L\'adresse de la branche ne peut pas dépasser 255 caractères.',
                ]
            );

            $agency = Agency::find($id)->update([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address)
            ]);

            return Redirect()->route('agencies');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function changeStatus($id)
    {
        $agency = Agency::find($id);
        $staffCount = Staff::where('agency_id', $id)->count();

        if ($staffCount > 0 && $agency->active == 1) {
            return Redirect()->Route('agencies')->withErrors(['error' => "La branche n'est pas vide. Elle contient $staffCount membre(s) du personnel."]);
        }

        $agency->active = !$agency->active;
        $agency->save();

        return Redirect()->route('agencies');
    }
}
