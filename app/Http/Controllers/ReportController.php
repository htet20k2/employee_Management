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

        $departments = Department::query();
        if ($request->filled('branch')) {
            $departments = $departments->where('branch_id', $request->branch);
        }
        
        $departments = $departments->get();

        $query = EmployeeDetail::query();
    
        if ($request->filled('branch')) {
            $query->where('branch_id', $request->branch);
        }

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
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

               $departments = collect();
               $ranks = collect(); 

            if ($request->filled('branch_id')) {
                $branch = Branch::with('departments')->find($request->branch_id);
                $departments = $branch ? $branch->departments : collect();
                if ($departments->isEmpty()) {
                    \Log::info('No departments found for branch ID: ' . $request->branch_id);
                }
            }
            
           
               if ($request->filled('department_id')) {
                   $department = Department::with('ranks')->find($request->department_id);
                   $ranks = $department ? $department->ranks : collect();
               }
           

        $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank'])->paginate(10);
    
        $uniqueEmployeeDetails = $query->get()
        ->unique('department_id') 
        ->values(); 

        $uniqueRankDetails = $query->get()
        ->unique('rank_id') 
        ->values(); 
        return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks', 'duties','uniqueEmployeeDetails','uniqueRankDetails'));

    }
    
    
}
