<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;

    // ✅ Kalau tabel kamu bernama 'proposal' (bukan plural default 'proposals')
    protected $table = 'proposal';

    // ✅ Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nama_instansi',
        'disposisi',
        'nilai_bantuan',
        'tanggal_proposal',
        'deskripsi',
        'created_by',
    ];

    // ✅ Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
