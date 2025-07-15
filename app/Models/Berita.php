<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    // ✅ Tambahkan ini untuk pakai tabel "berita" bukan "beritas"
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'sumber_media',
        'link',
        'jenis_berita',
        'tanggal_publikasi',
        'gambar',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
