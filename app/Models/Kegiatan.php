<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'tempat',
        'biaya',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'created_by',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'biaya' => 'decimal:2',
    ];

    // Relasi ke User (pembuat kegiatan)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
