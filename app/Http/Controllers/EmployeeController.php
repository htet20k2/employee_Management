<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{   
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employees = Employee::when($search, function($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        
        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:employees,email',
            'DOB' => 'required|date',
            'sex' => 'required|in:Male,Female,Other',
            'NRC' => 'required|string|unique:employees,NRC',
            'address' => 'required|string',
            'township' => 'required|string|max:100',
            'martial_status' => 'required|in:Single,Married,Divorced',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'race' => 'nullable|string|max:255',
            'religious' => 'nullable|string|max:255',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'education' => 'required|string|max:255',
            'other_qualification' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive,On Leave,Terminated,Suspended',
        ]);

        $employee = Employee::create($validated);
        
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('admin.employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('admin.employee.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => ['required', 'email', Rule::unique('employees')->ignore($employee->employee_id, 'employee_id')],
            'DOB' => 'required|date',
            'sex' => 'required|in:Male,Female,Other',
            'NRC' => ['required', 'string', Rule::unique('employees')->ignore($employee->employee_id, 'employee_id')],
            'address' => 'required|string',
            'township' => 'required|string|max:100',
            'martial_status' => 'required|in:Single,Married,Divorced',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'race' => 'nullable|string|max:255',
            'religious' => 'nullable|string|max:255',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'education' => 'required|string|max:255',
            'other_qualification' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive,On Leave,Terminated,Suspended',
        ]);

        $employee->update($validated);
        
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
