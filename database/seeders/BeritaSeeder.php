<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) {
            $this->command->warn('User belum tersedia. Seeder Berita dilewati.');
            return;
        }

        $news = [
            ['judul' => 'PTPN Gelar Aksi Tanam Pohon Serentak', 'sumber_media' => 'Humas PTPN', 'link' => 'https://ptpn.co.id/berita/tanam-pohon', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->toDateString(), 'gambar' => 'contoh.png'],
            ['judul' => 'Kecelakaan Kendaraan Operasional di Perkebunan', 'sumber_media' => 'Tribun Medan', 'link' => 'https://tribunnews.com/kecelakaan-ptpn', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(1)->toDateString(), 'gambar' => 'contoh.png'],
            ['judul' => 'Karyawan PTPN Raih Penghargaan Inovasi Nasional', 'sumber_media' => 'Kompas.com', 'link' => 'https://kompas.com/inovasi-karyawan-ptpn', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(2)->toDateString(), 'gambar' => 'contoh.png'],
            ['judul' => 'Masyarakat Komplain Asap dari Pabrik Sawit', 'sumber_media' => 'detik.com', 'link' => 'https://detik.com/berita/asap-ptpn', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(3)->toDateString(), 'gambar' => 'contoh.png'],
            ['judul' => 'PTPN Sukses Gelar Festival Budaya di Kebun', 'sumber_media' => 'Medan Today', 'link' => 'https://medantoday.com/festival-ptpn', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(4)->toDateString(), 'gambar' => 'contoh.png'],
            ['judul' => 'Demo Karyawan Tuntut Keadilan Upah', 'sumber_media' => 'CNN Indonesia', 'link' => 'https://cnnindonesia.com/demo-karyawan-ptpn', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(5)->toDateString(), 'gambar' => 'contoh.png'],
            ['judul' => 'PTPN Gandeng Universitas untuk Riset Pertanian', 'sumber_media' => 'Antara News', 'link' => 'https://antara.com/ptpn-riset', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(6), 'gambar' => 'contoh.png'],
            ['judul' => 'Truk Angkut Sawit Terguling, Sopir Luka Ringan', 'sumber_media' => 'Viva News', 'link' => 'https://viva.co.id/kecelakaan-truk', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(7), 'gambar' => 'contoh.png'],
            ['judul' => 'Program CSR PTPN Bangun Perpustakaan Desa', 'sumber_media' => 'Koran Harian', 'link' => 'https://koranharian.com/csr-ptpn', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(8), 'gambar' => 'contoh.png'],
            ['judul' => 'Kebakaran Lahan di Kebun Unit C', 'sumber_media' => 'Metro TV', 'link' => 'https://metrotvnews.com/kebakaran-ptpn', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(9), 'gambar' => 'contoh.png'],
            ['judul' => 'PTPN Terapkan Teknologi Smart Farming', 'sumber_media' => 'Techno News', 'link' => 'https://technonews.com/smartfarming', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(10), 'gambar' => 'contoh.png'],
            ['judul' => 'Protes Jalan Rusak Menuju Kebun Unit A', 'sumber_media' => 'Warta Utama', 'link' => 'https://warta.com/protes-jalan', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(11), 'gambar' => 'contoh.png'],
            ['judul' => 'PTPN Gelar Bazar Murah untuk Masyarakat', 'sumber_media' => 'Berita Harian', 'link' => 'https://beritaharian.com/bazar-ptpn', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(12), 'gambar' => 'contoh.png'],
            ['judul' => 'Pencurian TBS di Kebun Semakin Marak', 'sumber_media' => 'Kompas', 'link' => 'https://kompas.com/pencurian-tbs', 'jenis_berita' => 'negatif', 'tanggal_publikasi' => now()->subDays(13), 'gambar' => 'contoh.png'],
            ['judul' => 'Unit PTPN Raih ISO 9001 untuk Manajemen Mutu', 'sumber_media' => 'Sindo News', 'link' => 'https://sindonews.com/iso-ptpn', 'jenis_berita' => 'positif', 'tanggal_publikasi' => now()->subDays(14), 'gambar' => 'contoh.png'],
        ];

        foreach ($news as $item) {
            $item['created_by'] = $user->id;
            Berita::create($item);
        }
    }
}
