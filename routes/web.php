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
use App\Http\Controllers\BranchDetailController;
use App\Http\Controllers\DepartmentDetailController;
use App\Http\Controllers\RankController;
use App\Models\Department;
use App\Models\Rank;
use Illuminate\Http\Request;
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


    Route::resource('/branchdetail',BranchDetailController::class);

    Route::resource('/departmentdetail',DepartmentDetailController::class);


    Route::resource('/reports',ReportController::class);
    Route::resource('/details',DetailController::class);


   






});


