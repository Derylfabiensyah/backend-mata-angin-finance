<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Http\Requests\StorepengeluaranRequest;
use App\Http\Requests\UpdatepengeluaranRequest;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::with('user')->latest()->get();
        
        return response()->json([
            'message' => 'Data pengeluaran berhasil diambil',
            'data' => $pengeluaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'nama_barang' => 'required|string',
                'nominal' => 'required|numeric'
            ]);

            $pengeluaran = Pengeluaran::create([
                'nama_barang' => $request->nama_barang,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'created_by' => auth()->id()
            ]);

            // Reload data dari database
            $pengeluaran->refresh();

            return response()->json([
                'message' => 'Data pengeluaran berhasil ditambahkan',
                'data' => $pengeluaran
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::with('user')->findOrFail($id);
        
        return response()->json([
            'message' => 'Data pengeluaran berhasil diambil',
            'data' => $pengeluaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);
            
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'nama_barang' => 'required|string',
                'nominal' => 'required|numeric'
            ]);

            $pengeluaran->update([
                'nama_barang' => $request->nama_barang,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
            ]);

            return response()->json([
                'message' => 'Data pengeluaran berhasil diupdate',
                'data' => $pengeluaran
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengupdate data',
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return response()->json([
            'message' => 'Data pengeluaran berhasil dihapus'
        ]);
    }
}
