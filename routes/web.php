<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\EmployeeDetailController;
use App\Http\Controllers\BranchDetailController;
use App\Http\Controllers\DepartmentDetailController;
use App\Http\Controllers\RankController;
use App\Models\Department;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Exports\EmployeeDetailsExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');

    // city 
    Route::resource('/cities',CityController::class);

    // branches 
    Route::resource('/branches',BranchController::class);

    // department 
    Route::resource('/departments',DepartmentController::class);

    // duty 
    Route::resource('/duties',DutyController::class);

    // employee 
    Route::resource('/employee',EmployeeController::class);

    // rank 
    Route::resource('/rank',RankController::class);

    // employee detail 
    Route::resource('/employeedetail',EmployeeDetailController::class);

    // transfer 
    Route::resource('/transfers',TransferController::class);
    
    // branchdetail 
    Route::resource('/branchdetail',BranchDetailController::class);

    // departmentdetail 
    Route::resource('/departmentdetail',DepartmentDetailController::class);

    // report 
    Route::resource('/reports',ReportController::class);
    Route::resource('/details',DetailController::class);

    // employee detail
    Route::get('employeedetail/create', [EmployeeDetailController::class, 'create'])->name('employeedetail.create');
    Route::post('employeedetail/store', [EmployeeDetailController::class, 'store'])->name('employeedetail.store');


    // for excel export 
    Route::get('/export-employee-details', function (\Illuminate\Http\Request $request) {
        $filters = $request->only(['branch', 'department', 'duty', 'rank', 'is_training']);
        return Excel::download(new EmployeeDetailsExport($filters), 'employee_details.xlsx');
    })->name('employeeDetails.export');
});


