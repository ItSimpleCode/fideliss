<?php

use App\Http\Controllers\AuthController;
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





Route::middleware(['user.auth'])->group(function () {
    Route::get('/', function () {
        return view('layout.layout');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/staffs', function () {
        return view('admin.staff');
    })->name('staffs');


    Route::post('/staff-logout', [AuthController::class, 'logout'])->name('staff.logout')->defaults('guard', 'staff');
    Route::post('/admin-logout', [AuthController::class, 'logout'])->name('admin.logout')->defaults('guard', 'admin');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::get('/forgetPassword', [AuthController::class, 'showForgetPassword'])->name('forgetPassword.show');
Route::post('/forgetPassword', [AuthController::class, 'SendPasswordInMail'])->name('forgetPassword.sendPassword');



Route::get('addAdmin', [AuthController::class, 'addAdmin']);
Route::get('addStaf', [AuthController::class, 'addStaf']);
