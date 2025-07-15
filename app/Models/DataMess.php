<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataMess extends Model
{
    use HasFactory;

    protected $table = 'data_mess';

    protected $fillable = [
        'lokasi',
        'nomor_kamar',
        'jumlah_bed',
        'status',
    ];

    // Relasi ke status log mess
    public function statusLogs()
    {
        return $this->hasMany(StatusMessLog::class, 'mess_id');
    }

    // Relasi ke checkin mess
    public function checkin()
    {
        return $this->hasMany(CheckinMess::class, 'mess_id');
    }
}
