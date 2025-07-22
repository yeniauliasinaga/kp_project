<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    protected $table = 'supir';

    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
        'alamat',
        'nik',
        'status',
    ];

    public function permintaan()
    {
        return $this->hasMany(PermintaanKendaraan::class, 'supir_id', 'id');
    }

}
