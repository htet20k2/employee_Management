<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Rank;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Duty;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::all();
        $ranks = Rank::all();
        $duties = Duty::all();
        
        // Filter departments based on the selected branch if provided
        $departments = Department::query();
        if ($request->filled('branch')) {
            $departments = $departments->where('branch_id', $request->branch);
        }
        
        // Execute the query to fetch the departments as an actual collection
        $departments = $departments->get();
    
        // Continue with filtering EmployeeDetails
        $query = EmployeeDetail::query();
    
        if ($request->filled('branch')) {
            $query->where('branch_id', $request->branch);
        }
    
        if ($request->filled('duty')) {
            $query->where('duty_time_id', $request->duty);
        }
    
        if ($request->filled('rank')) {
            $query->where('rank_id', $request->rank);
        }
    
        if ($request->filled('is_training')) {
            $query->where('isTraining', $request->is_training === 'Yes' ? 1 : 0);
        }

        
    
        // Fetch employee details with relationships
        $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank'])->paginate(10);
    
        return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks', 'duties'));

    }
    
    
}
