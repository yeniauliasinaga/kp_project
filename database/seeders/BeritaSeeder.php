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
            [
                'judul' => 'PTPN Gelar Aksi Tanam Pohon Serentak',
                'sumber_media' => 'Humas PTPN',
                'link' => 'https://ptpn.co.id/berita/tanam-pohon',
                'jenis_berita' => 'positif',
                'tanggal_publikasi' => now()->toDateString(),
                'gambar' => 'tanam_pohon.jpg',
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Kecelakaan Kendaraan Operasional di Perkebunan',
                'sumber_media' => 'Tribun Medan',
                'link' => 'https://tribunnews.com/kecelakaan-ptpn',
                'jenis_berita' => 'negatif',
                'tanggal_publikasi' => now()->subDays(1)->toDateString(),
                'gambar' => 'kecelakaan.jpg',
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Karyawan PTPN Raih Penghargaan Inovasi Nasional',
                'sumber_media' => 'Kompas.com',
                'link' => 'https://kompas.com/inovasi-karyawan-ptpn',
                'jenis_berita' => 'positif',
                'tanggal_publikasi' => now()->subDays(2)->toDateString(),
                'gambar' => 'penghargaan.jpg',
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Masyarakat Komplain Asap dari Pabrik Sawit',
                'sumber_media' => 'detik.com',
                'link' => 'https://detik.com/berita/asap-ptpn',
                'jenis_berita' => 'negatif',
                'tanggal_publikasi' => now()->subDays(3)->toDateString(),
                'gambar' => 'asap_pabrik.jpg',
                'created_by' => $user->id,
            ],
            [
                'judul' => 'PTPN Sukses Gelar Festival Budaya di Kebun',
                'sumber_media' => 'Medan Today',
                'link' => 'https://medantoday.com/festival-ptpn',
                'jenis_berita' => 'positif',
                'tanggal_publikasi' => now()->subDays(4)->toDateString(),
                'gambar' => 'festival.jpg',
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Demo Karyawan Tuntut Keadilan Upah',
                'sumber_media' => 'CNN Indonesia',
                'link' => 'https://cnnindonesia.com/demo-karyawan-ptpn',
                'jenis_berita' => 'negatif',
                'tanggal_publikasi' => now()->subDays(5)->toDateString(),
                'gambar' => 'demo.jpg',
                'created_by' => $user->id,
            ],
        ];

        foreach ($news as $item) {
            Berita::create($item);
        }
    }
}
