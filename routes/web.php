<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Livewire\Account;
use App\Livewire\Index;
use App\Http\Controllers\AccountController;
use App\Livewire\TransferForm;
use App\Livewire\Transfer;
use App\Livewire\Reports\ViewReport;

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
Route::middleware(['web'])->group(function () {
    
   
    // Rutas de Livewire
    Route::get('/', Index::class);
    //Route::get('/accounts/account-list', Account::class);
    //Route::get('/', [AccountController::class, 'index']);


    Route::get('/accounts', Account::class)->name('accounts');
    Route::post('/transfer', [AccountController::class, 'transfer'])->name('accounts.transfer');
    
    //Route::get('/transfer-form', TransferForm::class)->name('transfer-form');
    Route::get('/reports/view', ViewReport::class)->name('reports.view');

});


