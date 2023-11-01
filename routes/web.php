<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Livewire\Account;
use App\Livewire\Index;
use App\Http\Controllers\AccountController;
use App\Livewire\Accounts\TransferAccount;
use App\Livewire\Reports\ViewReport;
use App\Livewire\Accounts\AccountForm;

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
    
    Route::get('/', Index::class)->name('index');

    Route::get('/accounts', Account::class)->name('accounts');
    
    Route::get('/reports/view', ViewReport::class)->name('reports.view');
    
    Route::get('/accounts/transfer-account', TransferAccount::class)->name('accounts.transfer-account');   
});


