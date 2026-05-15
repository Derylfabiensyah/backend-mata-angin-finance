<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UtangPiutangController;
use App\Http\Controllers\DashboardController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/laporan/harian', [DashboardController::class, 'laporanHarian']);
    Route::get('/laporan/bulanan', [DashboardController::class, 'laporanBulanan']);
    
    Route::apiResource('pemasukan', PemasukanController::class);
    Route::apiResource('pengeluaran', PengeluaranController::class);
    Route::apiResource('utang-piutang', UtangPiutangController::class);

});
