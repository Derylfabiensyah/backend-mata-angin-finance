<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukan = Pemasukan::sum('total_pemasukan');

        $totalPengeluaran = Pengeluaran::sum('nominal');

        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        $jumlahTransaksi = Pemasukan::count() + Pengeluaran::count();

         return response()->json([
            'message' => 'Dashboard keuangan',
            'data' => [
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
                'saldo_bersih' => $saldoBersih,
                'jumlah_transaksi' => $jumlahTransaksi
            ]
        ]);
    }

    public function laporanHarian(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal' => 'required|date'
        ]);

        $tanggal = $request->tanggal;

        $pemasukan = Pemasukan::whereDate('tanggal', $tanggal)->get();

        $pengeluaran = Pengeluaran::whereDate('tanggal', $tanggal)->get();

        $totalPemasukan = $pemasukan->sum('total_pemasukan');

        $totalPengeluaran = $pengeluaran->sum('nominal');

        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        return response()->json([
            'message' => 'Laporan harian berhasil diambil',
            'tanggal' => $tanggal,
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_bersih' => $saldoBersih,
            'data_pemasukan' => $pemasukan,
            'data_pengeluaran' => $pengeluaran
        ]);
    }

    public function laporanBulanan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $pemasukan = Pemasukan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

        $pengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

        $totalPemasukan =
        $pemasukan->sum('total_pemasukan');

        $totalPengeluaran = $pengeluaran->sum('nominal');

        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        return response()->json([
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_bersih' => $saldoBersih,
            'data_pemasukan' => $pemasukan,
            'data_pengeluaran' => $pengeluaran
        ]);

    }

    public function exportPdf()
    {
        try {
            $pemasukan = Pemasukan::all();
            $pengeluaran = Pengeluaran::all();

            $totalPemasukan = Pemasukan::sum('total_pemasukan');
            $totalPengeluaran = Pengeluaran::sum('nominal');
            $saldoBersih = $totalPemasukan - $totalPengeluaran;

            $pdf = Pdf::loadView(
                'laporan.pdf',
                compact(
                    'pemasukan',
                    'pengeluaran',
                    'totalPemasukan',
                    'totalPengeluaran',
                    'saldoBersih'
                )
            );

            return $pdf->download('laporan-keuangan.pdf');
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal generate PDF',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }
}
