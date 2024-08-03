<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
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

    Route::get('/dashboard/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/dashboard/admins/add', [AdminController::class, 'showAddForm'])->name('admins.add.show');
    Route::post('/dashboard/admins/add', [AdminController::class, 'create'])->name('admins.add.store');

    Route::get('/dashboard/branchs', [BranchController::class, 'index'])->name('branchs');
    Route::get('/dashboard/branchs/add', [BranchController::class, 'showAddForm'])->name('branchs.add.show');
    Route::post('/dashboard/branchs/add', [BranchController::class, 'create'])->name('branchs.add.store');
    Route::get('/dashboard/branchs/edite/{id}', [BranchController::class, 'showEditeForm'])->name('branchs.edite.show');
    Route::post('/dashboard/branchs/edite/{id}', [BranchController::class, 'edite'])->name('branchs.edite.store');

    Route::get('/dashboard/staffs', [StaffController::class, 'index'])->name('staffs');
    Route::get('/dashboard/staffs/add', [StaffController::class, 'showAddForm'])->name('staffs.add.show');
    Route::post('/dashboard/staffs/add', [StaffController::class, 'create'])->name('staffs.add.store');

    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/dashboard/clients/add', [ClientController::class, 'showAddForm'])->name('clients.add.show');
    Route::post('/dashboard/clients/add', [ClientController::class, 'create'])->name('clients.add.store');
    Route::get('/dashboard/clients/edite/{id}', [ClientController::class, 'showEditeForm'])->name('clients.edite.show');
    Route::post('/dashboard/clients/edite/{id}', [ClientController::class, 'edite'])->name('clients.edite.store');

    Route::get('/dashboard/cards', [CardController::class, 'index'])->name('cards');
    Route::get('/dashboard/cards/add', [CardController::class, 'show'])->name('cards.add.show');
    Route::post('/dashboard/cards/add', [CardController::class, 'create'])->name('cards.add.store');


    Route::get('/dashboard/client/{id}/cards', [CardController::class, 'showClientCards'])->name('client.cards');
    Route::get('/dashboard/client/{id}/cards/add', [CardController::class, 'showClientCardsAddForm'])->name('cards.create.show');
    Route::post('/dashboard/client/{id}/cards/add', [CardController::class, 'addCardToClient'])->name('cards.create.store');

    // Route::get('/dashboard/clients_cards', fn ()  => view('layouts.dashboard.card'))->name('clients_cards');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgetPassword', [AuthController::class, 'showForgetPassword'])->name('forgetPassword.show');
Route::post('/forgetPassword', [AuthController::class, 'SendPasswordInMail'])->name('forgetPassword.sendPassword');



Route::fallback(function () {
    return Auth::guard('admin')->check() || Auth::guard('staff')->check()
        ? redirect()->route('statistics')
        : redirect()->route('login.show');
});
