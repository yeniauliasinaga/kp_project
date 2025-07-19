<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jabatan',
        'role',
        'unit_id',
        'alamat',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Relasi ke Hotel
    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }

    // Relasi ke TiketPesawat
    public function tiketPesawat()
    {
        return $this->hasMany(TiketPesawat::class);
    }
}
