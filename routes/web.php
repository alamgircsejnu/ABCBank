<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transactions\TransactionController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', HomeController::class)->name('home');

    // Transactions
    Route::get('/deposit', [TransactionController::class, 'deposit'])->name('deposit');
    Route::post('/deposit', [TransactionController::class, 'processDeposit'])->name('deposit.process');
    Route::get('/withdraw', [TransactionController::class, 'withdraw'])->name('withdraw');
    Route::post('/withdraw', [TransactionController::class, 'processWithdraw'])->name('withdraw.process');
    Route::get('/transfer', [TransactionController::class, 'transfer'])->name('transfer');
    Route::post('/transfer', [TransactionController::class, 'processTransfer'])->name('transfer.process');
    Route::get('/statement', [TransactionController::class, 'statement'])->name('statement');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
