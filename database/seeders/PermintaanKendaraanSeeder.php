<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermintaanKendaraan;
use App\Models\User;
use App\Models\Supir;
use App\Models\Kendaraan;
use Carbon\Carbon;

class PermintaanKendaraanSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $supirs = Supir::take(5)->get();
        $kendaraans = Kendaraan::all();

        if (!$user || $supirs->isEmpty() || $kendaraans->isEmpty()) {
            $this->command->warn("❌ Data Supir, Kendaraan, atau User belum tersedia.");
            return;
        }

        // Ambil tanggal mulai sebulan yang lalu
        $startDate = Carbon::now()->subDays(30);

        for ($i = 0; $i < 30; $i++) {
            $kendaraan = $kendaraans[$i % $kendaraans->count()];
            $supir = $supirs[$i % $supirs->count()];
            
            $jadwalBerangkat = $startDate->copy()->addDays($i);
            $jadwalPulang = $jadwalBerangkat->copy()->addDays(rand(1, 5)); // pulang antara 1–5 hari setelahnya

            PermintaanKendaraan::create([
                'supir_id' => $supir->id,
                'no_polisi' => $kendaraan->no_polisi,
                'status_kepemilikan' => $kendaraan->status_kepemilikan,
                'jadwal_berangkat' => $jadwalBerangkat,
                'jadwal_pulang' => $jadwalPulang,
                'tujuan' => $i % 2 === 0 ? 'dalam wilayah' : 'luar wilayah',
                'created_by' => $user->id,
            ]);
        }

        $this->command->info("✅ Seeder PermintaanKendaraan berhasil dibuat dari 30 hari lalu sampai hari ini.");
    }
}
