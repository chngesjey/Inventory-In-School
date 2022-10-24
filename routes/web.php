<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    BarangController,
    TempatController
};

Route::get('/', function () {
    return view('login');
});

// Route Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route Barang
Route::resource('/barang', BarangController::class);
// Route Tempat
Route::resource('/tempat', TempatController::class);
