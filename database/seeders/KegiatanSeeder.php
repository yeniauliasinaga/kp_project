<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use App\Models\User;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn("User belum ada. Seeder Kegiatan dilewati.");
            return;
        }

        $kegiatan = [
            [
                'nama_kegiatan'   => 'Rapat Koordinasi Bulanan',
                'tempat'          => 'Ruang Rapat Kantor Pusat',
                'biaya'           => 5000000,
                'waktu_mulai'     => '2025-07-12',
                'waktu_selesai'   => '2025-07-13',
                'created_by'      => $user->id,
            ],
            [
                'nama_kegiatan'   => 'Workshop Digitalisasi',
                'tempat'          => 'Hotel Medan Inn',
                'biaya'           => 12500000,
                'waktu_mulai'     => '2025-07-15',
                'waktu_selesai'   => '2025-07-16',
                'created_by'      => $user->id,
            ],
            [
                'nama_kegiatan'   => 'Pelatihan Keamanan Pangan',
                'tempat'          => 'Kantor Unit Labuhan',
                'biaya'           => 3000000,
                'waktu_mulai'     => '2025-07-17',
                'waktu_selesai'   => '2025-07-17',
                'created_by'      => $user->id,
            ],
        ];

        foreach ($kegiatan as $item) {
            Kegiatan::create($item);
        }

        $this->command->info("✅ Seeder Kegiatan berhasil dijalankan.");
    }
}
