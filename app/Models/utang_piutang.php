<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtangPiutang extends Model
{
    use HasFactory;

    protected $table = 'utang_piutangs';

    protected $fillable = [
        'nama_customer',
        'jenis',
        'total_tagihan',
        'dp',
        'sisa_pembayaran',
        'tanggal_dp',
        'tanggal_pelunasan',
        'status',
        'keterangan',
        'created_by',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
