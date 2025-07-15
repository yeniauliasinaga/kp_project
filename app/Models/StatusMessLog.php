<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusMessLog extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti default plural ("status_mess_logs")
    protected $table = 'status_mess_log';

    // Karena tidak memakai created_at dan updated_at
    public $timestamps = false;

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'mess_id',
        'status',
        'waktu_perubahan',
        'keterangan',
        'created_by',
    ];

    // Relasi ke tabel mess
    public function mess()
    {
        return $this->belongsTo(DataMess::class, 'mess_id');
    }

    // Relasi ke user (pencatat perubahan)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
