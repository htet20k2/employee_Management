<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Rank;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Duty;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeeDetail::query();
    
        // Apply filters based on request input
        if ($request->has('search') && $request->search) {
            $query->where('branch_id', $request->search);
        }
    
        if ($request->has('duty_time') && $request->duty_time) {
            $query->where('duty_id', $request->duty_time);
        }
    
        if ($request->has('department_id') && $request->department_id) {
            $query->where('department_id', $request->department_id);
        }
    
        if ($request->has('rank_id') && $request->rank_id) {
            $query->where('rank_id', $request->rank_id);
        }
    
        // Fetch paginated results
        $employeedetaiils = $query->paginate(10); // Fetch 10 records per page
    
        // Fetch data for dropdown options
        $branchs = Branch::all();
        $dutytimes = Duty::all();
        $departments = Department::all();
        $ranks = Rank::all();
    
        return view('admin.report.index', compact('employeedetaiils', 'branchs', 'dutytimes', 'departments', 'ranks'));
    }
    
    
    
}
