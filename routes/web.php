<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TimeLigneController;
use App\Http\Controllers\TransactionDemandeController;
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
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard/statistics', [StatistiqueController::class, 'index'])->name('statistics');
        
        Route::get('/dashboard/actions', [ActionsController::class, 'index'])->name('actions');
        Route::get('/dashboard/actions/{id}/valider', [ActionsController::class, 'valider'])->name('actions.valider');
        Route::get('/dashboard/actions/{id}/invalider', [ActionsController::class, 'invalider'])->name('actions.invalider');
        
        Route::get('/dashboard/timelinge', [TimeLigneController::class, 'index'])->name('timeLine');

        Route::get('/dashboard/admins', [AdminController::class, 'index'])->name('admins');
        Route::get('/dashboard/admins/add', [AdminController::class, 'showAddForm'])->name('admins.add.show');
        Route::post('/dashboard/admins/add', [AdminController::class, 'create'])->name('admins.add.store');
        Route::get('/dashboard/admins/edit/{id}', [BranchController::class, 'edit'])->name('admins.edit.show');

        Route::get('/dashboard/branches', [BranchController::class, 'index'])->name('branches');
        Route::get('/dashboard/branches/add', [BranchController::class, 'showAddForm'])->name('branches.add.show');
        Route::post('/dashboard/branches/add', [BranchController::class, 'create'])->name('branches.add.store');
        Route::get('/dashboard/branches/edit/{id}', [BranchController::class, 'showEditForm'])->name('branches.edit.show');
        Route::post('/dashboard/branches/edit/{id}', [BranchController::class, 'edit'])->name('branches.edit.store');
        Route::get('/dashboard/branches/changeStatus/{id}', [BranchController::class, 'changeStatus'])->name('branches.edit.status');

        Route::get('/dashboard/staffs', [StaffController::class, 'index'])->name('staffs');
        Route::get('/dashboard/staffs/add', [StaffController::class, 'showAddForm'])->name('staffs.add.show');
        Route::post('/dashboard/staffs/add', [StaffController::class, 'create'])->name('staffs.add.store');
        Route::get('/dashboard/staffs/edit/{id}', [StaffController::class, 'showEditForm'])->name('staffs.edit.show');
        Route::post('/dashboard/staffs/edit/{id}', [StaffController::class, 'edit'])->name('staffs.edit.store');
        Route::get('/dashboard/staffs/changeStatus/{id}', [StaffController::class, 'changeStatus'])->name('staffs.edit.status');

        Route::get('/dashboard/cards', [CardController::class, 'index'])->name('cards');
        Route::get('/dashboard/cards/addTypeOfCard',  [CardController::class, 'showAddForm'])->name('cards.add.type.of.card');
        Route::post('/dashboard/cards/add', [CardController::class, 'create'])->name('cards.store.type.of.card');
        Route::get('/dashboard/cards/edit/{id}', [CardController::class, 'showEditForm'])->name('cards.edit.show');
        Route::post('/dashboard/cards/edit/{id}', [CardController::class, 'edit'])->name('cards.edit.store');
        Route::get('/dashboard/cards/changeStatus/{id}', [CardController::class, 'changeStatus'])->name('cards.edit.status');
    });

    Route::middleware(['staff.auth'])->group(function () {
        Route::get('/dashboard/transactionDemandes', [TransactionDemandeController::class, 'showByIdStaff'])->name('transaction.demande');
        Route::get('/dashboard/transactionDemandes/annuler/{id}', [TransactionDemandeController::class, 'annulerDemande'])->name('transaction.demande.annuler');
        Route::get('/dashboard/transactionDemandes/resend/{id}', [TransactionDemandeController::class, 'resendDemande'])->name('transaction.demande.resend');
        Route::get('/dashboard/transactionDemandes/edit/{id}', [TransactionDemandeController::class, 'showEditDemandePage'])->name('transaction.demande.edit.show');
        Route::post('/dashboard/transactionDemandes/edit/{id}', [TransactionDemandeController::class, 'EditDemande'])->name('transaction.demande.edit.store');
    });


    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/dashboard/clients/add', [ClientController::class, 'showAddForm'])->name('clients.add.show');
    Route::post('/dashboard/clients/add', [ClientController::class, 'create'])->name('clients.add.store');
    Route::get('/dashboard/clients/edit/{id}', [ClientController::class, 'showEditForm'])->name('clients.edit.show');
    Route::post('/dashboard/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit.store');
    Route::get('/dashboard/clients/changeStatus/{id}', [ClientController::class, 'changeStatus'])->name('clients.edit.status');

    Route::get('/dashboard/client/{id}/cards', [CardController::class, 'showClientCards'])->name('client.cards');
    Route::get('/dashboard/client/{id}/cards/add', [CardController::class, 'showClientCardsAddForm'])->name('cards.create.show');
    Route::post('/dashboard/client/{id}/cards/add', [CardController::class, 'addCardToClient'])->name('cards.create.store');

    Route::get('/dashboard/scanner', [CardController::class, 'showScannerPage'])->name('scanner.show');
    Route::get('/dashboard/addPoints', [CardController::class, 'showAddPointsPageByhand'])->name('scanner.addPoints.showv2');
    Route::post('/dashboard/addPoints/{id}', [CardController::class, 'AddPointsToCard'])->name('scanner.addPoints.store');



    Route::get('/set-theme/{theme}', [ThemeController::class, 'changeTheme'])->name('changeTheme');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgetPassword', [AuthController::class, 'showForgetPassword'])->name('forgetPassword.show');
Route::post('/forgetPassword', [AuthController::class, 'SendPasswordInMail'])->name('forgetPassword.sendPassword');


// Clients Space routes
Route::get('/clients_space', function () {
    return view('clients_space');
})->name('client.space');


Route::middleware('scanner.auth')->get('/dashboard/addPoints/{cardsSerial}', [CardController::class, 'showAddPointsPageBySanning'])->name('scanner.addPoints.show');

Route::fallback(function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('statistics');
    } elseif (Auth::guard('staff')->check()) {
        return redirect()->route('transaction.demande');
    } else {
        return redirect()->route('login.show');
    }
});
