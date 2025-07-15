<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Unit;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $pegawai = Pegawai::first();
        $unit = Unit::first();
        $user = User::first();

        if (!$pegawai || !$unit || !$user) {
            $this->command->warn("Seeder Hotel dilewati karena data pegawai/unit/user belum ada.");
            return;
        }

        $hotels = [
            [
                'pegawai_id' => $pegawai->id,
                'nama_hotel' => 'Hotel Bintang 5',
                'unit_id' => $unit->id,
                'biaya' => 750000.00,
                'tanggal_masuk' => now()->toDateString(),
                'tanggal_keluar' => now()->addDays(2)->toDateString(),
                'created_by' => $user->id,
            ],
            [
                'pegawai_id' => $pegawai->id,
                'nama_hotel' => 'Hotel Mawar Indah',
                'unit_id' => $unit->id,
                'biaya' => 450000.00,
                'tanggal_masuk' => now()->addDays(5)->toDateString(),
                'tanggal_keluar' => now()->addDays(7)->toDateString(),
                'created_by' => $user->id,
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
