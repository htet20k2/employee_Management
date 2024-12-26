<?php

namespace App\Http\Controllers;

use App\Models\Late;
use App\Models\Employee;
use Illuminate\Http\Request;

class LateController extends Controller
{

    public function index()
    {
        $lates = Late::with('employee')->get();
        return view('admin.late.index', compact('lates'));
    }


    public function create()
    {
        $employees = Employee::all();
        return view('admin.late.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'latedate' => 'required|date',
            'latemin' => 'required|integer|min:1',
            'description' => 'required|string|max:255',
        ]);

        Late::create($request->all());

        return redirect()->route('lates.index')->with('success', 'Late entry added successfully.');
    }


    public function edit($id)
    {
        $late = Late::findOrFail($id);
        $employees = Employee::all();
        return view('admin.late.edit', compact('late', 'employees'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'latedate' => 'required|date',
            'latemin' => 'required|integer|min:1',
            'description' => 'required|string|max:255',
        ]);

        $late = Late::findOrFail($id);
        $late->update($request->all());

        return redirect()->route('lates.index')->with('success', 'Late entry updated successfully.');
    }

 
    public function destroy($id)
    {
        $late = Late::findOrFail($id);
        $late->delete();
        return redirect()->route('lates.index')->with('success', 'Late entry deleted successfully.');
    }
}
