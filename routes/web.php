<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Authcontroller::class, 'showlogin'])->name('login');
Route::post('/', [Authcontroller::class, 'login']);
Route::get('/register', [Authcontroller::class, 'showregister'])->name('register');
Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');


Route::middleware(['auth', 'UserAkses:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'UserAkses:member'])->prefix('member')->name('member.')->group(function() {
    Route::get('/dashboard', [Dashboardcontroller::class, 'index'])->name('dashboard');
    Route::resource('borrow', BorrowController::class);
    Route::resource('return', ReturnController::class);
});



