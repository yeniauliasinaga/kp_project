<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $primaryKey = 'no_polisi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_polisi',
        'merek',
        'model',
        'bahan_bakar',
        'status_kepemilikan',
        'status',
    ];

    // Relasi ke log status kendaraan
    public function statusLog()
    {
        return $this->hasMany(StatusKendaraanLog::class, 'no_polisi', 'no_polisi');
    }

    // Relasi ke permintaan kendaraan
    public function permintaan()
    {
        return $this->hasMany(PermintaanKendaraan::class, 'no_polisi', 'no_polisi');
    }
}
