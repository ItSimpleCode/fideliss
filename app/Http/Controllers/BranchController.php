<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $columns = ['name', 'address'];
        $fields = ['name', 'address'];
        $data = Branch::select('id', 'name', 'address')
            ->orderBy('created_at')
            ->get();
        $table = 'branchs';
        return view('layouts.dashboard.table', compact('data', 'columns', 'fields', 'table'));
    }

    public function showAddForm()
    {
        return view('layouts.dashboard.branchs.add');
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'address' => 'required|max:255',
            ]);

            $branch = new Branch;
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->save();

            return redirect()->route('branchs');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }

    public function showEditeForm($id)
    {
        $branch = Branch::select('id', 'name', 'address')
            ->where('id', $id)
            ->first();

        return view('layouts.dashboard.branchs.edite', compact('branch'));
    }

    public function edite(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'address' => 'required|max:255',
            ]);

            $branch = Branch::find($id);
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->update();

            return redirect()->route('branchs');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }
}
