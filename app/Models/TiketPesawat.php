<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TiketPesawat extends Model
{
    use HasFactory;

    // Jika nama tabel di database adalah "tiket_pesawat", ini opsional (Laravel akan menebak otomatis).
    protected $table = 'tiket_pesawat';

    // Kolom-kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'pegawai_id',
        'tujuan',
        'tanggal',
        'biaya',
        'created_by',
    ];

    // Relasi ke model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    // Relasi ke model User (yang membuat data)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
