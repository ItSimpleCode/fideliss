<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $columns = ["Nom", "Adresse", 'Personnel'];
        $fields = ['name', 'address', 'staffs_count'];
        $data = Branch::select('id', 'name', 'address', 'active')
            ->withCount(['staffs'])
            ->orderBy('created_at', 'desc')
            ->get();
        $table = 'branches';
        return view('pages.dashboard.branches.branches', compact('data', 'columns', 'fields', 'table'));
    }

    public function showAddForm()
    {
        return view('pages.dashboard.branches.add');
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'address' => 'required|max:255',
            ], [
                'name.required' => 'Le nom de la branche est requis.',
                'name.max' => 'Le nom de la branche ne peut pas dépasser 255 caractères.',
                'address.required' => 'L\'adresse de la branche est requise.',
                'address.max' => 'L\'adresse de la branche ne peut pas dépasser 255 caractères.',
            ]);

            $branch = new Branch;
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->save();

            return redirect()->route('branches');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function showEditForm($id)
    {
        $branch = Branch::select('id', 'name', 'address')
            ->where('id', $id)
            ->first();

        return view('pages.dashboard.branches.edit', compact('branch'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'address' => 'required|max:255',
            ], [
                'name.required' => 'Le nom de la branche est requis.',
                'name.max' => 'Le nom de la branche ne peut pas dépasser 255 caractères.',
                'address.required' => 'L\'adresse de la branche est requise.',
                'address.max' => 'L\'adresse de la branche ne peut pas dépasser 255 caractères.',
            ]);

            $branch = Branch::find($id);
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->update();

            return redirect()->route('branches');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function changeStatus($id)
    {
        $branch = Branch::find($id);
        $staffCount = Staff::where('id_branch', $id)->count();

        if ($staffCount > 0) {
            return back()->withErrors(['error' =>  "La branche n'est pas vide. Elle contient $staffCount membre(s) du personnel."]);
        }

        $branch->active = !$branch->active;
        $branch->save();

        return redirect()->route('branches');
    }
}
