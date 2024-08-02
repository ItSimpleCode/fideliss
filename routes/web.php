<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CardController;

use Illuminate\Support\Facades\Auth;
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




// Private routes
Route::middleware(['user.auth'])->group(function () {
    Route::get('/dashboard/statistics', [AuthController::class, 'showStatistics'])->name('statistics');
    Route::get('/dashboard/admins', [AuthController::class, 'showAdmins'])->name('admins');
    Route::get('/dashboard/branchs', [BranchController::class, 'index'])->name('branchs');
    Route::get('/dashboard/staffs', [AuthController::class, 'showStaffs'])->name('staffs');
    Route::get('/dashboard/clients', [AuthController::class, 'showClients'])->name('clients');
    Route::get('/dashboard/client/{id}/cards', [CardController::class, 'showClientCards'])->name('client.cards');
    Route::get('/dashboard/cards', [CardController::class, 'index'])->name('cards');
    Route::get('/dashboard/cards/new', fn ()  => view('layouts.dashboard.card_create'))->name('cards.create');

    Route::get('/dashboard/clients_cards', fn ()  => view('layouts.dashboard.card'))->name('clients_cards');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgetPassword', [AuthController::class, 'showForgetPassword'])->name('forgetPassword.show');
Route::post('/forgetPassword', [AuthController::class, 'SendPasswordInMail'])->name('forgetPassword.sendPassword');



Route::fallback(function () {
    return Auth::check()
        ? redirect()->route('statistics')
        : redirect()->route('login.show');
});

// Route::get('addAdmin', [AuthController::class, 'addAdmin']);
// Route::get('addStaf', [AuthController::class, 'addStaf']);
