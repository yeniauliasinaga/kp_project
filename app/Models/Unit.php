<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'unit'; // Nama tabel (jika tidak jamak)
    
    protected $fillable = [
        'nama_unit',
    ];

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    // Relasi ke Hotel
    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }
}
