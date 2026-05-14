<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukan = Pemasukan::sum('total_pemasukan');

        $totalPengeluaran = Pengeluaran::sum('nominal');

        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        return response()->json([
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_bersih' => $saldoBersih
        ]);
    }
}
