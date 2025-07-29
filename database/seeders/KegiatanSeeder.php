<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Str;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user dari daftar pegawai di UserSeeder
        $userIds = [];

        foreach (UserSeeder::$userMap as $name => $id) {
            $user = User::find($id);
            if ($user) {
                $userIds[] = $user->id;
            }
        }

        if (count($userIds) === 0) {
            $this->command->warn("Tidak ada user valid. Seeder Kegiatan dilewati.");
            return;
        }

        $namaKegiatanList = [
            'Rapat Koordinasi', 'Workshop Digitalisasi', 'Pelatihan Pangan',
            'Sosialisasi Keselamatan Kerja', 'Monitoring Lapangan', 'Rapat Anggaran',
            'Kunjungan Mitra', 'Pelatihan IT', 'Diskusi Strategi', 'Rapat Tim Inti',
        ];

        $tempatList = [
            'Ruang Rapat Pusat', 'Hotel Medan Inn', 'Kantor Unit A',
            'Hotel Binjai City', 'Kantor Unit Labuhan', 'Ruang Zoom',
            'Auditorium Utama', 'Gedung Pelatihan', 'Kantor Regional', 'Unit Samping Timur',
        ];

        for ($i = 0; $i < 30; $i++) {
        $mulai = now()->addDays(rand(-10, 10))->setTime(rand(8, 16), rand(0, 59));
        $selesai = (clone $mulai)->addHours(rand(1, 4));

        if ($selesai->isPast()) {
            $status = 'selesai';
        } elseif ($mulai->isFuture()) {
            $status = 'akan_datang';
        } else {
            $status = 'berlangsung';
        }

        Kegiatan::create([
            'nama_kegiatan' => $namaKegiatanList[array_rand($namaKegiatanList)] . ' #' . Str::random(4),
            'tempat' => $tempatList[array_rand($tempatList)],
            'biaya' => rand(1, 20) * 1000000,
            'waktu_mulai' => $mulai,
            'waktu_selesai' => $selesai,
            'gambar' => 'contoh.png',
            'status' => $status,
            'created_by' => $userIds[array_rand($userIds)],
        ]);

        }
    }
}
