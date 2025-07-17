<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusKendaraanLog;
use App\Models\Kendaraan;
use App\Models\User;

class StatusKendaraanLogSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $kendaraans = Kendaraan::all();

        if (!$user || $kendaraans->isEmpty()) {
            $this->command->warn("StatusKendaraanLogSeeder: Data tidak lengkap.");
            return;
        }

        for ($i = 0; $i < 15; $i++) {
            $kendaraan = $kendaraans[$i % $kendaraans->count()];

            StatusKendaraanLog::create([
                'no_polisi' => $kendaraan->no_polisi,
                'status' => $kendaraan->status,
                'keterangan' => 'Log perubahan status kendaraan ke-' . ($i + 1),
                'created_by' => $user->id,
                'waktu_perubahan' => now()->addMinutes($i * 5),
            ]);
        }
    }
}
