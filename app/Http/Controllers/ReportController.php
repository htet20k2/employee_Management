<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Rank;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Duty;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        // Get all branches, departments, and ranks for the dropdowns
        $branches = Branch::all();
        $departments = Department::all();
        $ranks = Rank::all();
        $duties = Duty::all(); // Assuming you have a Duty model
    
        // Start the query for employee details
        $query = EmployeeDetail::with(['branch', 'department', 'rank']);
    
        // Filter by branch if provided
        if ($request->filled('branch')) {
            $query->where('branch_id', $request->branch);
        }
    
        // Filter by department if provided
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }
    
        // Filter by rank if provided
        if ($request->filled('rank')) {
            $query->where('rank_id', $request->rank);
        }
    
        // Filter by duty status if provided
        if ($request->filled('duty')) {
            $query->where('duty_id', $request->duty);
        }
    
        // Filter by is_training status if provided
        if ($request->filled('is_training')) {
            $query->where('is_training', $request->is_training === 'Yes');
        }
    
        // Execute the query and get the results
        $employeeDetails = $query->paginate(10); // Adjust the pagination as necessary
    
        return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks', 'duties'));
    }

    public function getDepartments($branchId)
    {
        // Assuming 'branch_id' is the foreign key in the departments table
        $departments = Department::where('branch_id', $branchId)->get();
    
        return response()->json([
            'departments' => $departments
        ]);
    }
    
public function getRanks($departmentId)
{
    $ranks = Rank::where('department_id', $departmentId)->get();
    return response()->json(['ranks' => $ranks]);
}

    
    
}