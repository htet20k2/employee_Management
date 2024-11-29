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

        $reports = Report::with(['branchs', 'departments', 'dutytimes', 'ranks','employeedetaiils'])
             ->when($search, function($query) use ($search) {
                 $query->whereHas('branch', function ($branchQuery) use ($search) {
                     $branchQuery->where('name', 'like', '%' . $search . '%'); // Adjust for case sensitivity if needed
                 });
             })
             ->paginate(10)
             ->appends(['search' => $search]);
    
        // Fetch data for dropdown options
        $branchs = Branch::all();
        $dutytimes = Duty::all();
        $departments = Department::all();
        $ranks = Rank::all();
        $employeedetaiils = EmployeeDetail::all();

    
        // Return the view with filtered results
        return view('admin.report.index', compact('employeedetaiils', 'branchs', 'dutytimes', 'departments', 'ranks'));
    }
    
}
