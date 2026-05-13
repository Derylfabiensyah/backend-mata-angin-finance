<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'nama_barang',
        'nominal',
        'keterangan',
        'tanggal',
        'created_by',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
