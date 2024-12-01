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

    // Apply filters based on request inputs
    if ($request->has('branch') && $request->branch) {
        $query->where('branch_id', $request->branch);
    }

    if ($request->has('department') && $request->department) {
        $query->where('department_id', $request->department);
    }

    if ($request->has('duty_status') && $request->duty_status) {
        $query->whereHas('duties', function ($q) use ($request) {
            $q->where('status', $request->duty_status);
        });
    }

    if ($request->has('rank') && $request->rank) {
        $query->where('rank_id', $request->rank);
    }

    // Other filters like enroll date or isTraining
    if ($request->has('is_training') && $request->is_training !== null) {
        $query->where('isTraining', $request->is_training == 'Yes' ? 1 : 0);
    }

    // Pagination and eager loading
    $employeeDetails = $query->with(['branch', 'department', 'duties', 'rank'])
        ->paginate(10);

    $branches = Branch::all();
    $departments = Department::all();
    $ranks = Rank::all();

    return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks'));
}

    
    
}
