<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Rank;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Duty;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeeDetail::query();

        // Filter by branch
        if ($request->filled('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Filter by department (ensure it belongs to the selected branch)
        if ($request->filled('department')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('id', $request->department)
                  ->where('branch_id', $request->branch); // Ensure department belongs to selected branch
            });
        }

        // Filter by rank (ensure it belongs to the selected department)
        if ($request->filled('rank')) {
            $query->whereHas('rank', function ($q) use ($request) {
                $q->where('id', $request->rank)
                  ->where('department_id', $request->department); // Ensure rank belongs to selected department
            });
        }

        // Filter by duty
        if ($request->filled('duty')) {
            $query->where('duty_time_id', $request->duty);
        }

        // Filter by is_training
        if ($request->filled('is_training')) {
            $query->where('isTraining', $request->is_training === 'Yes' ? 1 : 0);
        }

        // Load related models with pagination
        $employeeDetails = $query->with(['branch', 'department', 'rank', 'duties'])->paginate(10);

        // Dropdown data for filters
        $branches = Branch::all();
        $departments = Department::all();
        $ranks = Rank::all(); 
        $duties = Duty::all();

        return view('admin.report.index', compact('employeeDetails', 'branches', 'departments', 'ranks', 'duties'));
    }

    public function getDepartmentsByBranch($branchId): JsonResponse
    {
        return response()->json(Department::where('branch_id', $branchId)->get());
    }

    public function getRanksByDepartment($departmentId): JsonResponse
    {
        return response()->json(Rank::where('department_id', $departmentId)->get());
    }
}