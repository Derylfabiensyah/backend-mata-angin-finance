<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class, 'created_by');
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'created_by');
    }

    public function utangPiutang()
    {
        return $this->hasMany(UtangPiutang::class, 'created_by');
    }
}