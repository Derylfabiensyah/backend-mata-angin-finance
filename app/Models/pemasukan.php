<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukans';

    protected $fillable = [
        'tanggal',
        'hari',
        'cash',
        'transfer_bca',
        'qris_dana',
        'denda',
        'kerusakan',
        'dp',
        'total_pemasukan',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}