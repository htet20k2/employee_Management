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
        $query = EmployeeDetail::query();
    
        if ($request->has('branch') && $request->branch) {
            $query->where('branch_id', $request->branch);
        }
    
        if ($request->has('department') && $request->department) {
            $query->where('department_id', $request->department);
        }
    
        if ($request->has('duty') && $request->duty) {
            $query->where('duty_time_id', $request->duty);
        }
    
        if ($request->has('rank') && $request->rank) {
            $query->where('rank_id', $request->rank);
        }
    
        if ($request->has('is_training') && $request->is_training !== null) {
            $query->where('isTraining', $request->is_training == 'Yes' ? 1 : 0);
        }
    
    
        // Fetch data
        $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank'])->paginate(10);
    
 
        // Fetch filter data
        $branches = Branch::all();
        $departments = Department::all();
        $ranks = Rank::all();
        $duties = Duty::all();
        $employeeDetails=EmployeeDetail::all();

    
        return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks', 'duties'));
    }

    
    
}