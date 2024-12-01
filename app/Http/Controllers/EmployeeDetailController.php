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
        $search = $request->input('search'); // Get search input.
        $query = EmployeeDetail::query();   // Initialize the query builder.
    
        // Include relationships in the query and filter with search.
        if (!empty($search)) {
            $query->whereHas('branch', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('department', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('rank', function ($q) use ($search) {
                $q->where('rank', 'like', "%{$search}%");
            });
        }
    
        // Fetch data with pagination.
        $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank'])
                                 ->paginate(10);
    
        // Return to the view.
        return view('admin.employeedetails.index', compact('employeeDetails'));
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
            'enroll_date' => 'required',
            'isTraining' => 'required|boolean',
            'permanent_date' => 'required',
            'emp_photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'rank_id' => 'required|exists:ranks,id',
        ]);

      
        $employeeDetail = new EmployeeDetail();
        $employeeDetail->branch_id = $request->branch_id;
        $employeeDetail->department_id = $request->department_id;
        $employeeDetail->duty_time_id = $request->duty_status;
        $employeeDetail->enroll_date = $request->enroll_date;
        $employeeDetail->isTraining = $request->isTraining;
        $employeeDetail->permanent_date = $request->permanent_date;
        $employeeDetail->rank_id = $request->rank_id;
        $employeeDetail->save();

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
/**
 * Update the specified resource in storage.
 */
public function update($id, Request $request)
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

    $employeeDetail = EmployeeDetail::find($id);

    if (!$employeeDetail) {
        return redirect()->route('employeedetail.index')->with('error', 'Employee not found.');
    }

    $employeeDetail->branch_id = $request->branch_id;
    $employeeDetail->department_id = $request->department_id;
    $employeeDetail->duty_time_id = $request->duty_status;
    $employeeDetail->enroll_date = $request->enroll_date;
    $employeeDetail->isTraining = $request->isTraining;
    $employeeDetail->permanent_date = $request->permanent_date;
    $employeeDetail->rank_id = $request->rank_id;

    // Handle photo upload
    if ($request->hasFile('emp_photos')) {
        if ($employeeDetail->emp_photos && file_exists(public_path('images/' . $employeeDetail->emp_photos))) {
            unlink(public_path('images/' . $employeeDetail->emp_photos));
        }

        $imgName = time() . '.' . $request->emp_photos->extension();
        $request->emp_photos->move(public_path('images'), $imgName);
        $employeeDetail->emp_photos = $imgName;
    }

    $employeeDetail->update();

    if ($employeeDetail->update()) {
        return redirect()->route('employeedetail.index')->with('success', 'Employee Detail updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update Employee Detail.');
    }
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
