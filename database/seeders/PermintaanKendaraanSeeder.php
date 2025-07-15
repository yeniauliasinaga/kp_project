<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermintaanKendaraan;
use App\Models\User;
use App\Models\Supir;
use App\Models\Kendaraan;

class PermintaanKendaraanSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $supir = Supir::first();
        $kendaraans = Kendaraan::where('status', 'tersedia')->get();

        if (!$user || !$supir || $kendaraans->isEmpty()) {
            $this->command->warn("❌ User, Supir, atau Kendaraan belum tersedia. Seeder PermintaanKendaraan dilewati.");
            return;
        }

        $requests = [];

        foreach ($kendaraans as $index => $kendaraan) {
            $requests[] = [
                'supir_id' => $supir->id,
                'no_polisi' => $kendaraan->no_polisi,
                'status_kepemilikan' => $kendaraan->status_kepemilikan,
                'jadwal_berangkat' => now()->addDays($index + 1),
                'jadwal_pulang' => now()->addDays($index + 3),
                'tujuan' => $index % 2 === 0 ? 'dalam wilayah' : 'luar wilayah',
                'created_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        PermintaanKendaraan::insert($requests);

        $this->command->info("✅ PermintaanKendaraanSeeder berhasil dijalankan dengan " . count($requests) . " data.");
    }
}
