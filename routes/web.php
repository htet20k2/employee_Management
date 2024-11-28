<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
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

    Route::resource('/employee',EmployeeController::class);

    Route::resource('/rank',RankController::class);


});
