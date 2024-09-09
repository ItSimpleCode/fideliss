<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TimeLigneController;
use App\Http\Controllers\PendingTransactionController;

//use App\Http\Controllers\ClientSpaceController;
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

Route::middleware(['user.auth'])->group(function () {
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard/statistics', [StatistiqueController::class, 'index'])->name('statistics');

        Route::get('/dashboard/timeline', [TimeLigneController::class, 'index'])->name('timeLine');
        Route::get('/dashboard/timeline/{table}', [TimeLigneController::class, 'show'])->name('timeLine.show');

        Route::get('/dashboard/admins', [AdminController::class, 'index'])->name('admins');

        Route::get('/dashboard/agencies', [AgencyController::class, 'index'])->name('agencies');
        Route::get('/dashboard/agencies/add', [AgencyController::class, 'create'])->name('agencies.create');
        Route::post('/dashboard/agencies/add', [AgencyController::class, 'insert'])->name('agencies.insert');
        Route::get('/dashboard/agencies/edit/{id}', [AgencyController::class, 'edit'])->name('agencies.edit');
        Route::post('/dashboard/agencies/edit/{id}', [AgencyController::class, 'update'])->name('agencies.update');
        Route::get('/dashboard/agencies/changeStatus/{id}', [AgencyController::class, 'changeStatus'])->name('agencies.changeStatus');

        Route::get('/dashboard/staffs', [StaffController::class, 'index'])->name('staffs');
        Route::get('/dashboard/staffs/add', [StaffController::class, 'create'])->name('staffs.create');
        Route::post('/dashboard/staffs/add', [StaffController::class, 'insert'])->name('staffs.insert');
        Route::get('/dashboard/staffs/edit/{id}', [StaffController::class, 'edit'])->name('staffs.edit');
        Route::post('/dashboard/staffs/edit/{id}', [StaffController::class, 'update'])->name('staffs.update');
        Route::get('/dashboard/staffs/changeStatus/{id}', [StaffController::class, 'changeStatus'])->name('staffs.changeStatus');

        Route::get('/dashboard/cards', [CardController::class, 'index'])->name('cards');
        Route::get('/dashboard/cards/add', [CardController::class, 'create'])->name('cards.create');
        Route::post('/dashboard/cards/add', [CardController::class, 'insert'])->name('cards.insert');
        Route::get('/dashboard/cards/edit/{id}', [CardController::class, 'edit'])->name('cards.edit');
        Route::post('/dashboard/cards/edit/{id}', [CardController::class, 'update'])->name('cards.update');
        Route::get('/dashboard/cards/changeStatus/{id}', [CardController::class, 'changeStatus'])->name('cards.changeStatus');
    });

    /* Pending transactions */
    Route::get('/dashboard/pending_transactions', [PendingTransactionController::class, 'index'])->name('pending_transactions');
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard/pending_transactions/{id}/valid', [PendingTransactionController::class, 'valid'])->name('transaction.valid');
        Route::get('/dashboard/pending_transactions/{id}/invalid', [PendingTransactionController::class, 'invalid'])->name('transaction.invalid');
    });
    Route::middleware(['staff.auth'])->group(function () {
        Route::post('/dashboard/pending_transactions/edit/{id}', [PendingTransactionController::class, 'update'])->name('pending_transaction.update');
        Route::get('/dashboard/pending_transactions/delete/{id}', [PendingTransactionController::class, 'delete'])->name('pending_transaction.delete');
    });
    Route::get('/dashboard/pending_transactions/edit/{id}', [PendingTransactionController::class, 'edit'])->name('pending_transaction.edit');

    /* Clients */
    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/dashboard/clients/add', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/dashboard/clients/add', [ClientController::class, 'insert'])->name('clients.insert');
    Route::get('/dashboard/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/dashboard/clients/edit/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::post('/dashboard/clients/transaction', [ClientController::class, 'searchForCard'])->name('clients.searchForCard');
    Route::get('/dashboard/clients/transaction/{card_serial}', [ClientController::class, 'wallet'])->name('clients.wallet');
    Route::post('/dashboard/clients/transaction/{card_serial}', [ClientController::class, 'transaction'])->name('clients.transaction');
    Route::get('/dashboard/clients/renew/{id}', [ClientController::class, 'renew'])->name('clients.renew');
    Route::get('/dashboard/clients/history/{id}', [ClientController::class, 'history'])->name('clients.history');
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard/clients/active/{id}', [ClientController::class, 'active'])->name('clients.active');
        Route::get('/dashboard/clients/deactivate/{id}', [ClientController::class, 'deactivate'])->name('clients.deactivate');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgetPassword', [AuthController::class, 'showForgetPassword'])->name('forgetPassword.show');
Route::post('/forgetPassword', [AuthController::class, 'SendPasswordInMail'])->name('forgetPassword.sendPassword');

Route::get('/clients_space/{id}', [ClientSpaceController::class, 'index']);

// Clients Space routes
// Route::get('/clients_space', function () {
//     return view('clients_space');
// })->name('client.space');


Route::middleware('scanner.auth')->get('/dashboard/addPoints/{cardsSerial}', [CardController::class, 'showAddPointsPageByScanning'])->name('scanner.addPoints.show');

Route::fallback(function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('statistics');
    } elseif (Auth::guard('staff')->check()) {
        return redirect()->route('transaction.demande');
    } else {
        return redirect()->route('login.show');
    }
});
