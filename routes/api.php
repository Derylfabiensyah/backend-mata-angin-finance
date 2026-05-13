<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PemasukanController;
use App\Http\Controllers\API\PengeluaranController;
use App\Http\Controllers\API\UtangPiutangController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('pemasukan', PemasukanController::class);

    Route::apiResource('pengeluaran', PengeluaranController::class);

    Route::apiResource('utang-piutang', UtangPiutangController::class);

});
