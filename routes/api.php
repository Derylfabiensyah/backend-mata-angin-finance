<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UtangPiutangController;
use App\Http\Controllers\DashboardController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware([
    'auth:sanctum',
    'role:admin'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::get('/laporan/harian', [DashboardController::class,'laporanHarian']);
    Route::get('/laporan/bulanan', [DashboardController::class,'laporanBulanan']);
    Route::get('/laporan/export-pdf', [DashboardController::class,'exportPdf']);

    Route::get('/pemasukan', [PemasukanController::class,'index']);
    Route::get('/pemasukan/{pemasukan}', [PemasukanController::class,'show']);
    Route::put('/pemasukan/{pemasukan}', [PemasukanController::class,'update']);
    Route::delete('/pemasukan/{pemasukan}', [PemasukanController::class,'destroy']);

    Route::get('/pengeluaran', [PengeluaranController::class,'index']);
    Route::get('/pengeluaran/{pengeluaran}', [PengeluaranController::class,'show']);
    Route::put('/pengeluaran/{pengeluaran}', [PengeluaranController::class,'update']);
    Route::delete('/pengeluaran/{pengeluaran}', [PengeluaranController::class,'destroy']);

    Route::get('/utang-piutang', [UtangPiutangController::class,'index']);
    Route::get('/utang-piutang/{utangPiutang}', [UtangPiutangController::class,'show']);
    Route::put('/utang-piutang/{utangPiutang}', [UtangPiutangController::class,'update']);
    Route::delete('/utang-piutang/{utangPiutang}', [UtangPiutangController::class,'destroy']);
});

Route::middleware([
    'auth:sanctum',
    'role:admin,operator'
])->group(function () {
    Route::post('/pemasukan', [PemasukanController::class,'store']);
    Route::post('/pengeluaran', [PengeluaranController::class,'store']);
    Route::post('/utang-piutang', [UtangPiutangController::class,'store']);
});