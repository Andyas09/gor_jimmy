<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JadwalOperasionalController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HargaController;

// User
Route::get('/', [HomeController::class, 'index'])->name('home');
// web.php
Route::get('/cek-jadwal', [BookingController::class, 'cekJadwal']);
Route::post('/booking', [BookingController::class, 'storeBooking'])->name('booking.submit');
Route::get('/invoice/{orderId}', [BookingController::class, 'invoice'])
    ->name('booking.invoice');






// Admin

Route::get('/gor-jimmy', [AuthController::class, 'login'])->name('login');
Route::post('/proses-login', [AuthController::class, 'proses_login'])->name('proses.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/daftar-member', [AuthController::class, 'register'])->name('register');
Route::post('/proses-daftar', [AuthController::class, 'proses_register'])->name('proses.register');

Route::middleware(['auth', 'Role:Admin,Member'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
});

// Lapangan
Route::middleware(['auth', 'Role:Admin'])->name('lapangan.')->group(function () {
    Route::get('/lapangan-index', [LapanganController::class, 'index'])
        ->name('index');
    Route::post('/store-lapangan', [LapanganController::class, 'store'])->name('store');
    Route::put('/update-lapangan-{id}', [LapanganController::class, 'update'])
        ->name('update');
    Route::delete('/destroy-lapangan-{id}', [LapanganController::class, 'destroy'])
        ->name('destroy');
});

// Galeri
Route::middleware(['auth', 'Role:Admin'])->name('galeri.')->group(function () {
    Route::get('/galeri-index', [GaleriController::class, 'index'])
        ->name('index');
    Route::post('/store-galeri', [GaleriController::class, 'store'])->name('store');
    Route::put('/update-galeri-{id}', [GaleriController::class, 'update'])
        ->name('update');
    Route::delete('/destroy-galeri-{id}', [GaleriController::class, 'destroy'])
        ->name('destroy');
});

// Harga
Route::middleware(['auth', 'Role:Admin'])->name('harga.')->group(function () {
    Route::get('/harga-index', [HargaController::class, 'index'])
        ->name('index');
    Route::post('/store-harga', [HargaController::class, 'store'])->name('store');
    Route::put('/update-harga-{id}', [HargaController::class, 'update'])
        ->name('update');
    Route::delete('/destroy-harga-{id}', [HargaController::class, 'destroy'])
        ->name('destroy');
});

// Jadwal Operasional
Route::middleware(['auth', 'Role:Admin'])->name('jadwal.')->group(function () {
    Route::get('/jadwal-index', [JadwalOperasionalController::class, 'index'])
        ->name('index');
    Route::post('/store-jadwal', [JadwalOperasionalController::class, 'store'])->name('store');
    Route::put('/update-jadwal-{id}', [JadwalOperasionalController::class, 'update'])
        ->name('update');
    Route::delete('/destroy-jadwal-{id}', [JadwalOperasionalController::class, 'destroy'])
        ->name('destroy');
});

// Booking
Route::middleware(['auth', 'Role:Admin,Member'])->name('booking.')->group(function () {
    Route::get('/booking-index', [BookingController::class, 'index'])
        ->name('index');
    Route::post('/store-booking', [BookingController::class, 'store'])->name('store');
    Route::put('/update-booking-{id}', [BookingController::class, 'update'])
        ->name('update');
    Route::delete('/destroy-booking-{id}', [BookingController::class, 'destroy'])
        ->name('destroy');
});

// User
Route::middleware(['auth', 'Role:Admin'])->name('user.')->group(function () {
    Route::get('/user-index', [UserController::class, 'index'])
        ->name('index');
    Route::post('/user-store', [UserController::class, 'store'])->name('store');
    Route::put('/user-update-{id}', [UserController::class, 'update'])
        ->name('update');
    Route::delete('/user-destroy-{id}', [UserController::class, 'destroy'])
        ->name('destroy');
});

Route::middleware(['auth', 'Role:Member'])->name('profil.')->group(function () {
    Route::get('/profil', [MemberController::class, 'profil'])
        ->name('index');
    Route::post('/store-user', [MemberController::class, 'store'])->name('store');
    Route::put('/update-user-{id}', [MemberController::class, 'update'])
        ->name('update');
    Route::delete('/destroy-user-{id}', [MemberController::class, 'destroy'])
        ->name('destroy');
});

// Member
// Redundant route removed to resolve conflict with /dashboard URI in Admin group

// Laporan
Route::middleware(['auth', 'Role:Admin'])->group(function () {
    Route::get('/laporan-index', [\App\Http\Controllers\LaporanController::class, 'index'])
        ->name('laporan.index');
});