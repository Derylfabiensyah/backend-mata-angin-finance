<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Requests\StorepemasukanRequest;
use App\Http\Requests\UpdatepemasukanRequest;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukan = Pemasukan::with('user')->latest()->get();
        
        return response()->json([
            'message' => 'Data pemasukan berhasil diambil',
            'data' => $pemasukan
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
                'hari' => 'required|string'
            ]);

            $total = 
                ($request->cash ?? 0) +
                ($request->transfer_bca ?? 0) +
                ($request->qris_dana ?? 0) +
                ($request->denda ?? 0) +
                ($request->kerusakan ?? 0) +
                ($request->dp ?? 0);

            $pemasukan = Pemasukan::create([
                'tanggal' => $request->tanggal,
                'hari' => $request->hari,
                'cash' => $request->cash ?? 0,
                'transfer_bca' => $request->transfer_bca ?? 0,
                'qris_dana' => $request->qris_dana ?? 0,
                'denda' => $request->denda ?? 0,
                'kerusakan' => $request->kerusakan ?? 0,
                'dp' => $request->dp ?? 0,
                'total_pemasukan' => $total,
                'created_by' => auth()->id()
            ]);

            // Reload data dari database
            $pemasukan->refresh();

            return response()->json([
                'message' => 'Data pemasukan berhasil ditambahkan',
                'data' => $pemasukan
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
        $pemasukan = Pemasukan::with('user')->findOrFail($id);
        
        return response()->json([
            'message' => 'Data pemasukan berhasil diambil',
            'data' => $pemasukan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        $request->validate([
            'tanggal' => 'required',
            'hari' => 'required'
        ]);

        $total = 
                ($request->cash ?? 0) +
                ($request->transfer_bca ?? 0) +
                ($request->qris_dana ?? 0) +
                ($request->denda ?? 0) +
                ($request->kerusakan ?? 0) +
                ($request->dp ?? 0);

        $pemasukan->update([
                'tanggal' => $request->tanggal,
                'hari' => $request->hari,
                'cash' => $request->cash ?? 0,
                'transfer_bca' => $request->transfer_bca ?? 0,
                'qris_dana' => $request->qris_dana ?? 0,
                'denda' => $request->denda ?? 0,
                'kerusakan' => $request->kerusakan ?? 0,
                'dp' => $request->dp ?? 0,
                'total_pemasukan' => $total,
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $pemasukan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();

        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}
