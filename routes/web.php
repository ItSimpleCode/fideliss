<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ClientCardsController;
use App\Models\ClientCards;
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

    Route::get('/dashboard/statistics', [AuthController::class, 'showStatistics'])->name('statistics');
    Route::get('/dashboard/admins', [AuthController::class, 'showAdmins'])->name('admins');
    Route::get('/dashboard/staffs', [AuthController::class, 'showStaffs'])->name('staffs');
    Route::get('/dashboard/clients', [AuthController::class, 'showClients'])->name('clients');
    Route::get('/dashboard/client/{id}/cards', [CardController::class, 'showClientCards'])->name('client.cards');


    Route::get('/dashboard/cards', function () {
        return view('layouts.dashboard.card');
    })->name('cards');



    Route::fallback(function () {
        return redirect()->route('statistics');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::fallback(fn () => redirect()->route('login.show'));

Route::get('/forgetPassword', [AuthController::class, 'showForgetPassword'])->name('forgetPassword.show');
Route::post('/forgetPassword', [AuthController::class, 'SendPasswordInMail'])->name('forgetPassword.sendPassword');

Route::fallback(function () {
    return redirect()->route('login.show');
});

// Route::get('addAdmin', [AuthController::class, 'addAdmin']);
// Route::get('addStaf', [AuthController::class, 'addStaf']);
