<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDetail;
use App\Http\Requests\StoreEmployeeDetailRequest;
use App\Http\Requests\UpdateEmployeeDetailRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Duty;
use App\Models\Rank;
use Illuminate\Http\Request;

class EmployeeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
     public function index(Request $request)
     {
         $search = $request->input('search');
     
         // Fetch employee details with relationships and search by branch name
         $employeeDetails = EmployeeDetail::with(['branch', 'department', 'duties', 'rank'])
             ->when($search, function($query) use ($search) {
                 $query->whereHas('branch', function ($branchQuery) use ($search) {
                     $branchQuery->where('name', 'like', '%' . $search . '%'); // Adjust for case sensitivity if needed
                 });
             })
             ->paginate(10)
             ->appends(['search' => $search]);
     
         $branchs = Branch::all();
         $departments = Department::all();
         $dutytimes = Duty::all();
         $ranks = Rank::all();
     
         return view('admin.employeedetails.index', compact('employeeDetails', 'branchs', 'departments', 'dutytimes', 'ranks'));
     }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $branchs = Branch::all();
        $departments = Department::all();
        $dutytimes = Duty::all();
        $ranks = Rank::all();
        $employeeDetail = EmployeeDetail::all();
        return view('admin.employeedetails.create', compact('branchs','departments','dutytimes','ranks', 'employeeDetail'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'duty_status' => 'required|exists:duties,id',
            'enroll_date' => 'required|date',
            'isTraining' => 'required|boolean',
            'permanent_date' => 'required|date',
            'emp_photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'rank_id' => 'required|exists:ranks,id',
        ]);

        $employeeDetail = EmployeeDetail::create([
            'branch_id' => $request->branch_id,
            'department_id' => $request->department_id,
            'duty_time_id' => $request->duty_status,
            'enroll_date' => $request->enroll_date,
            'isTraining' => $request->isTraining,
            'permanent_date' => $request->permanent_date,
            'rank_id' => $request->rank_id,
        ]);

        // Check if a photo is uploaded
        if ($request->hasFile('emp_photos')) {
            $imgName = time() . '.' . $request->emp_photos->extension();
            $request->emp_photos->move(public_path('images'), $imgName);
            $employeeDetail->emp_photos = $imgName;
            $employeeDetail->save();
        } else {
            $employeeDetail->emp_photos = null;
        }

        return redirect()->route('employeedetail.index')->with('success', 'Employee Detail added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.employeedetails.show', compact('employeedetail'));

    }


    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $branchs = Branch::all();
        $departments = Department::all();
        $dutytimes = Duty::all();
        $ranks = Rank::all();
        $employeedetail = EmployeeDetail::findOrFail($id);
        return view('admin.employeedetails.edit',compact('branchs', 'departments', 'dutytimes', 'ranks', 'employeedetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'=> 'required|unique:employee_details,name,' .$id, // Updated table name
            ]
        );
        $employeeDetail = EmployeeDetail::findOrFail($id);
        $employeeDetail->update([
            'name' => $request->name,
            // Add other fields as necessary
        ]);

        return redirect()->route('employeedetail.index')->with('success', 'Employee Detail updated successfully.'); // Updated route
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = EmployeeDetail::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee Detail deleted successfully.');
    }
}
