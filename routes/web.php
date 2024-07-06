<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationalController;

Route::get('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [HomeController::class, 'index']);

Route::prefix('/operational')->group(function () {
    Route::get('/pendapatan-pertanggal', [OperationalController::class, 'PendapatanPerTanggal']);
    Route::get('/history-statlement', [OperationalController::class, 'HistoryStatlement']);
    Route::get('/pendapatan-summary', [OperationalController::class, 'PendapatanSummary']);
    Route::get('/transaksi-kendaraan-masuk', [OperationalController::class, 'TransaksiKendaraanMasuk']);
    Route::get('/transaksi-kendaraan-keluar', [OperationalController::class, 'TransaksiKKendaraanKeluar']);
});
