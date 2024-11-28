<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\DashboardController;
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
});


