<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinMess extends Model
{
    protected $table = 'checkin_mess';

    protected $fillable = [
        'mess_id', 'nama_tamu', 'asal', 'waktu_mulai', 'waktu_selesai', 'biaya', 'created_by'
    ];

    public function mess()
    {
        return $this->belongsTo(DataMess::class, 'mess_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
