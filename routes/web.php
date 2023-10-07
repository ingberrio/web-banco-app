<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Livewire\Account;
use App\Livewire\Index;
use App\Http\Controllers\AccountController;
use App\Http\Livewire\TransferForm;

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

Route::get('transfer-form', Index::class)->name('transfer-form');

Route::get('/', Index::class);

Route::get('/accounts', Account::class)->name('accounts');
Route::post('/transfer', [AccountController::class, 'transfer'])->name('transfer');
