<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    BarangController,
    TempatController,
    KategoriController
};

Route::get('/', function () {
    return view('auth.login');
});

// Route Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/simpanRegister', [AuthController::class, 'simpanRegister'])->name('simpanRegister');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

// Route Barang
Route::get('/barang/data', [BarangController::class, 'data'])->name('barang.data');
Route::get('/barang/pdf/{id}', [BarangController::class, 'pdf'])->name('barang.pdf');
Route::resource('/barang', BarangController::class);

/// Route Tempat
Route::get('/tempat/data', [TempatController::class, 'data'])->name('tempat.data');
Route::resource('/tempat', TempatController::class);

// Route Kategori
Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
Route::resource('/kategori', KategoriController::class);
