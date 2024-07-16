<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationalController;
use App\Http\Controllers\UserController;

Route::any('/login', [AuthController::class, 'login'])->middleware('loggedIn')->name('login');
Route::get('/profile', [AuthController::class, 'profile'])->middleware('isLogin')->name('profile');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('isLogin')->name('logout');

Route::get('/', [HomeController::class, 'index'])->middleware('isLogin')->name('home');

Route::prefix('/operational')->middleware('isLogin')->group(function () {
    Route::any('/pendapatan-pertanggal', [OperationalController::class, 'PendapatanPerTanggal'])->name('pendapatan-pertanggal');
    Route::get('/history-statlement', [OperationalController::class, 'HistoryStatlement'])->name('history-statlement');
    Route::get('/pendapatan-summary', [OperationalController::class, 'PendapatanSummary'])->name('pendapatan-summary');
    Route::get('/transaksi-kendaraan-masuk', [OperationalController::class, 'TransaksiKendaraanMasuk'])->name('transaksi-kendaraan-masuk');
    Route::get('/transaksi-kendaraan-keluar', [OperationalController::class, 'TransaksiKendaraanKeluar'])->name('transaksi-kendaraan-keluar');
});

Route::prefix('/dashboard')->middleware('isLogin')->group( function () {
    Route::get('membership', [HomeController::class, 'DashboardMembership'])->name('dashboard-membership');
    Route::get('pendapatan', [HomeController::class, 'DashboardPendapatan'])->name('dashboard-pendapatan');
    Route::get('realtime', [HomeController::class, 'DashboardRealtime'])->name('dashboard-realtime');
    Route::get('slide', [HomeController::class, 'DashboardSlide'])->name('dashboard-slide');
    Route::get('volume', [HomeController::class, 'DashboardVolume'])->name('dashboard-volume');
});

Route::prefix('/user')->middleware('isLogin')->group(function () {
    Route::any('/list', [UserController::class, 'ListUsers'])->name('list-users');
    Route::any('/hak-akses', [UserController::class, 'HakAkses'])->name('hak-akses');
});