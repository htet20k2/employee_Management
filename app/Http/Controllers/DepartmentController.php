<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
        
    public function index(Request $request)
    {
        $search = $request->input('search');
        $departments = Department::
        when($search, function($query) use ($search){
            return $query->where('name', 'ilike', '%' . $search . '%');
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=> 'required|unique:branches,name',
                'description' => 'required',
            ]
            );

            $department = new Department();
            $department->name=$request->name;
            $department->description=$request->description;
            $department -> save();
            return redirect()->route('departments.index')->with('success', 'Department added successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.department.edit',compact('department'));
    }

    public function update($id,Request $request)
    {
        $request->validate(
            [
                'name'=> 'required|unique:departments,name,' .$id,
                'description'=>'required',
            ]
            );
            $department=Department::findOrFail($id);
            $department->name=$request->name;
            $department->description=$request->description;
            $department->update();

            return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
