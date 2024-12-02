<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDetailController;
use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');

    // city
    Route::resource('/cities',CityController::class);


    // branch
    Route::resource('/branches',BranchController::class);

    //Department
    Route::resource('/departments',DepartmentController::class);

    //duty_time
    Route::resource('/duties',DutyController::class);
    Route::resource('/employee',EmployeeController::class);

    Route::resource('/rank',RankController::class);

    Route::resource('/employeedetail',EmployeeDetailController::class);

    Route::resource('/reports',ReportController::class);
    Route::resource('/details',DetailController::class);

    // Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');


    // Route::get('/departments', function (Request $request) {
    //     $branchId = $request->query('branch_id');
    //     return Department::where('branch_id', $branchId)->get();
    // });
    
    // Route::get('/ranks', function (Request $request) {
    //     $departmentId = $request->query('department_id');
    //     return Rank::where('department_id', $departmentId)->get();
    // });
    
    Route::get('/api/departments/{branchId}', function ($branchId) {
        return Department::where('branch_id', $branchId)->get();
    });
    
    Route::get('/api/ranks/{departmentId}', function ($departmentId) {
        return Rank::where('department_id', $departmentId)->get();
    });
    



});


