<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusKendaraanLog extends Model
{
    protected $table = 'status_kendaraan_log';
    public $timestamps = false;

    protected $fillable = [
        'no_polisi', 'status', 'waktu_perubahan', 'keterangan', 'created_by',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'no_polisi', 'no_polisi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
