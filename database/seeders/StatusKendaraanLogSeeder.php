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

        if (!$user || Kendaraan::count() == 0) {
            return;
        }

        $kendaraans = Kendaraan::all();

        foreach ($kendaraans as $kendaraan) {
            StatusKendaraanLog::create([
                'no_polisi' => $kendaraan->no_polisi,
                'status' => $kendaraan->status,
                'keterangan' => 'Status awal kendaraan',
                'created_by' => $user->id,
                'waktu_perubahan' => now()
            ]);
        }
    }
}
