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

        for ($i = 0; $i < 15; $i++) {
            $kendaraan = $kendaraans[$i % $kendaraans->count()];
            $supir = $supirs[$i % $supirs->count()];

            PermintaanKendaraan::create([
                'supir_id' => $supir->id,
                'no_polisi' => $kendaraan->no_polisi,
                'status_kepemilikan' => $kendaraan->status_kepemilikan,
                'jadwal_berangkat' => Carbon::now()->addDays($i),
                'jadwal_pulang' => Carbon::now()->addDays($i + 2),
                'tujuan' => $i % 2 === 0 ? 'dalam wilayah' : 'luar wilayah',
                'created_by' => $user->id,
            ]);
        }
    }
}
