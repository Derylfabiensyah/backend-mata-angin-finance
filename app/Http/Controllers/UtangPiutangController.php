<?php

namespace App\Http\Controllers;

use App\Models\UtangPiutang;
use App\Http\Requests\Storeutang_piutangRequest;
use App\Http\Requests\Updateutang_piutangRequest;
use Illuminate\Http\Request;

class UtangPiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UtangPiutang::with('user')->latest()->get();

        return response()->json([
            'message' => 'Data utang piutang berhasil diambil',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string',
                'tipe' => 'required|in:customer,supplier',
                'total_tagihan' => 'required|numeric'
            ]);

            $dp = $request->dp ?? 0;
            $sisaPembayaran = $request->total_tagihan - $dp;

            $utangPiutang = UtangPiutang::create([
                'nama' => $request->nama,
                'tipe' => $request->tipe,
                'total_tagihan' => $request->total_tagihan,
                'dp' => $dp,
                'sisa_pembayaran' => $sisaPembayaran,
                'status' => $request->status ?? 'belum_lunas',
                'keterangan' => $request->keterangan,
                'created_by' => auth()->id(),
            ]);

            return response()->json([
                'message' => 'Data utang piutang berhasil ditambahkan',
                'data' => $utangPiutang
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
        $utangPiutang = UtangPiutang::with('user')->findOrFail($id);
        
        return response()->json([
            'message' => 'Data utang piutang berhasil diambil',
            'data' => $utangPiutang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $utangPiutang = UtangPiutang::findOrFail($id);
            
            $validated = $request->validate([
                'nama' => 'sometimes|required|string',
                'tipe' => 'sometimes|required|in:customer,supplier',
                'total_tagihan' => 'sometimes|required|numeric',
                'dp' => 'nullable|numeric',
                'status' => 'nullable|in:belum_lunas,lunas',
                'keterangan' => 'nullable|string'
            ]);

            // Hitung sisa pembayaran jika total_tagihan atau dp berubah
            if ($request->has('total_tagihan') || $request->has('dp')) {
                $totalTagihan = $request->total_tagihan ?? $utangPiutang->total_tagihan;
                $dp = $request->dp ?? $utangPiutang->dp;
                $validated['sisa_pembayaran'] = $totalTagihan - $dp;
            }

            $utangPiutang->update($validated);

            return response()->json([
                'message' => 'Data utang piutang berhasil diupdate',
                'data' => $utangPiutang->fresh()
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
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
        $utangPiutang = UtangPiutang::findOrFail($id);
        $utangPiutang->delete();

        return response()->json([
            'message' => 'Data utang piutang berhasil dihapus'
        ]);
    }
}
