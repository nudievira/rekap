<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){ return redirect()->route('dashboard'); })->name('home');

Route::prefix('dashboard')->middleware(['auth','verified'])->group(function(){
    Route::get('/', [FormController::class,'index'])->name('dashboard');
    Route::get('/transaksi', [IndexController::class,'transaksi'])->name('transaksi');
    Route::get('/delete-transaksi{id}', [IndexController::class,'deleteTransaksi'])->name('delete-transaksi');
    Route::resources([
        'barang'=>BarangController::class,
        'customer'=>CustomerController::class,
        'user'=>UserController::class,
        'form'=>FormController::class
    ]);
});

require __DIR__.'/auth.php';
