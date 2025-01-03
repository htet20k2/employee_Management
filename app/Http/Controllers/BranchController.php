<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    
     public function index(Request $request)
     {
         $search = $request->input('search');
         $branches = Branch::
         when($search, function($query) use ($search){
             return $query->where('name', 'ilike', '%' . $search . '%');
         })
         ->paginate(10)
         ->appends(['search' => $search]);
         return view('admin.branch.index', compact('branches'));
     }


    public function create()
    {
        return view('admin.branch.create');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=> 'required|unique:branches,name',
                'address' => 'required',
            ]
            );

            $branch= new Branch();
            $branch->name=$request->name;
            $branch->address=$request->address;
            $branch->save();

            return redirect()->route('branches.index')->with('success', 'Branch added successfully.');
    }


    public function show(Branch $branch)
    {
        //
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branch.edit',compact('branch'));
    }

    public function update($id,Request $request)
    {
        $request->validate(
            [
                'name'=> 'required|unique:branches,name,' .$id,
                'address'=>'required',
            ]
            );
            $branch = Branch::findOrFail($id);
            $branch->name=$request->name;
            $branch->address=$request->address;
            $branch->update();

            return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }
    
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }

    
}
