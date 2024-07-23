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
    Route::any('/history-statlement', [OperationalController::class, 'HistoryStatlement'])->name('history-statlement');
    Route::any('/pendapatan-summary', [OperationalController::class, 'PendapatanSummary'])->name('pendapatan-summary');
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
    Route::get('/user-delete/{id}', [UserController::class, 'DeleteUser']);
    Route::post('/update-user/{id}', [UserController::class, 'UpdateUser']);
    Route::any('/hak-akses', [UserController::class, 'HakAkses'])->name('hak-akses');
    Route::any('/hakakses-tambah', [UserController::class, 'AddHakAkses']);
    Route::any('/hakakses-update/{id}', [UserController::class, 'UpdateHakAkses']);
    Route::get('/hakakses-delete/{id}', [UserController::class, 'DeleteHakAkses']);
});

Route::prefix('/export')->middleware('isLogin')->group(function(){
    Route::get('/pendapatan-summary', [OperationalController::class, 'ExportPendSummary']);
    // Route::get('/statlement', [OperationalController::class, 'ExportStatlement']);
    // Route::get('/kendaraan-masuk', [OperationalController::class, 'ExportKendaraanMasuk']);
    // Route::get('/kendaraan-keluar', [OperationalController::class, 'ExportKendaraanKeluar']);
});