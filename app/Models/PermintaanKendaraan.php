<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermintaanKendaraan extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti default Laravel ("permintaan_kendaraans")
    protected $table = 'permintaan_kendaraan';

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'supir_id',
        'no_polisi',
        'status_kepemilikan',
        'jadwal_berangkat',
        'jadwal_pulang',
        'tujuan',
        'created_by',
    ];

    /**
     * Relasi ke kendaraan berdasarkan no_polisi (kolom khusus)
     */
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'no_polisi', 'no_polisi');
    }

    /**
     * Relasi ke supir
     */
    public function supir()
    {
        return $this->belongsTo(Supir::class, 'supir_id');
    }

    /**
     * Relasi ke user yang menginput data
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
