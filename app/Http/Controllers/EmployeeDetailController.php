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
use Illuminate\Support\Facades\Log;


class EmployeeDetailController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $query = EmployeeDetail::query();  
    
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
    
    public function create(Request $request)
    {
        // Fetch all branches and other required models
        $branches = Branch::with('departments')->get(); // Eager load departments
        $dutytimes = Duty::all();
    
        // Initialize variables for departments and ranks
        $departments = collect();
        $ranks = collect(); 
    
        // Filter departments based on branch_id
        if ($request->filled('branch_id')) {
            $branch = $branches->find($request->branch_id); // Use already fetched branches
            $departments = $branch ? $branch->departments : collect();
        }
    
        // Filter ranks based on department_id
        if ($request->filled('department_id')) {
            $department = Department::with('ranks')->find($request->department_id);
            $ranks = $department ? $department->ranks : collect(); // Always an empty collection if no ranks
        }

        // dd($request->all());
    
        // Pass data to the view
        return view('admin.employeedetails.create', compact(
            'branches',
            'departments',
            'ranks',
            'dutytimes'
        ));
    }
    
    
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'rank_id' => 'required|exists:ranks,id',
            'duty_time_id' => 'required|exists:duties,id',
            'enroll_date' => 'required|date',
            'permanent_date' => 'required|date',
            'emp_photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
    
        try {
            $employeeDetail = new EmployeeDetail();
    
            $employeeDetail->branch_id = $validated['branch_id'];
            $employeeDetail->department_id = $validated['department_id'];
            $employeeDetail->rank_id = $validated['rank_id'];
            $employeeDetail->duty_time_id = $validated['duty_time_id'];
            $employeeDetail->enroll_date = $validated['enroll_date'];
            $employeeDetail->permanent_date = $validated['permanent_date'];
    
            // Save Photo
            if ($request->hasFile('emp_photos')) {
                $filename = time() . '.' . $request->emp_photos->extension();
                $request->emp_photos->move(public_path('images/employees'), $filename);
                $employeeDetail->emp_photos = $filename;
            }
    
            $employeeDetail->save();
    
            return redirect()->route('employeedetail.index')->with('success', 'Employee added successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the employee.');
        }
    }
    
    
    

 
    public function show(string $id)
    {
        return view('admin.employeedetails.show', compact('employeedetail'));

    }



    public function edit(string $id)
    {
        
        
        $branchs = Branch::all();
        $departments = Department::all();
        $dutytimes = Duty::all();
        $ranks = Rank::all();
        $employeedetail = EmployeeDetail::findOrFail($id);
        return view('admin.employeedetails.edit',compact('branchs', 'departments', 'dutytimes', 'ranks', 'employeedetail'));
    }

 
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






    public function destroy(string $id)
    {
        $employee = EmployeeDetail::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee Detail deleted successfully.');
    }
    
}
