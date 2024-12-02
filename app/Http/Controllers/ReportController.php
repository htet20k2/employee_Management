<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\EmployeeDetail;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Rank;
use App\Models\Duty;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeeDetail::query();
    
        // Apply filters based on the request
        if ($request->has('branch') && $request->branch) {
            $query->whereHas('branch', function($q) use ($request) {
                $q->where('id', $request->branch);
            });
        }
    
        if ($request->has('department') && $request->department) {
            $query->whereHas('department', function($q) use ($request) {
                $q->where('id', $request->department);
            });
        }
    
        if ($request->has('rank') && $request->rank) {
            $query->whereHas('rank', function($q) use ($request) {
                $q->where('id', $request->rank);
            });
        }
    
        if ($request->has('duty') && $request->duty) {
            $query->where('duty_time_id', $request->duty);
        }
    
        if ($request->has('is_training') && $request->is_training !== null) {
            $isTraining = $request->is_training === 'Yes' ? 1 : 0;
            $query->where('isTraining', $isTraining);
        }
    
        // Eager load relationships and paginate
        $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank'])->paginate(10);
    
        // Fetch filter options
        $branches = Branch::all();
        $departments = Department::all();
        $ranks = Rank::all();
        $duties = Duty::all();
    
        return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks', 'duties'));


    }

    
    
    
}
