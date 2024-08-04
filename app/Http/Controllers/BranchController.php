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

    public function showEditeForm($id)
    {
        $branch = Branch::select('id', 'name', 'address')
            ->where('id', $id)
            ->first();

        return view('pages.dashboard.branches.edit', compact('branch'));
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

            return redirect()->route('branches');
        } catch (Exception $e) {
            return back()->withErrors(['error' =>  $e->getMessage()]);
        }
    }
}
