<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return inertia('Welcome');
});

//Route::get('/', function () {
//    return inertia('Admin/Dashboard');
//});

//Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/slider', [SliderController::class, 'index'])->name('slider');
