<?php

use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Kelola\LaporanController as KelolaLaporan;
use App\Http\Controllers\Pelapor\LaporanController as PelaporLaporan;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// ---------- Publik (tanpa login) ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/panduan', [HomeController::class, 'panduan'])->name('panduan');
Route::get('/cek-status', [HomeController::class, 'cekStatus'])->name('cek-status');

Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register'])->name('register.store');
});

// ---------- Wajib login ----------
Route::middleware('auth')->group(function () {
    Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', fn () => redirect()->route(auth()->user()->homeRoute()))->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Pelapor (siswa / guru)
    Route::middleware('role:pelapor')->prefix('pelapor')->name('pelapor.')->group(function () {
        Route::get('/', [PelaporLaporan::class, 'dashboard'])->name('dashboard');
        Route::get('/laporan', [PelaporLaporan::class, 'index'])->name('laporan.index');
        Route::get('/laporan/buat', [PelaporLaporan::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [PelaporLaporan::class, 'store'])->name('laporan.store');
        Route::get('/laporan/{laporan}', [PelaporLaporan::class, 'show'])->name('laporan.show');
    });

    // Petugas & Admin
    Route::middleware('role:admin,petugas')->prefix('kelola')->name('kelola.')->group(function () {
        Route::get('/', [KelolaLaporan::class, 'dashboard'])->name('dashboard');
        Route::get('/laporan', [KelolaLaporan::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [KelolaLaporan::class, 'show'])->name('laporan.show');
        Route::put('/laporan/{laporan}', [KelolaLaporan::class, 'update'])->name('laporan.update');
        Route::get('/rekap', [KelolaLaporan::class, 'rekap'])->name('rekap');
        Route::get('/rekap/csv', [KelolaLaporan::class, 'rekapCsv'])->name('rekap.csv');
    });

    // Khusus Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/pengguna', [UserController::class, 'index'])->name('users.index');
        Route::post('/pengguna', [UserController::class, 'store'])->name('users.store');
        Route::put('/pengguna/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
        Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
        Route::put('/lokasi/{lokasi}', [LokasiController::class, 'update'])->name('lokasi.update');
        Route::delete('/lokasi/{lokasi}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

        Route::delete('/laporan/{laporan}', [KelolaLaporan::class, 'destroy'])->name('laporan.destroy');
    });
});
