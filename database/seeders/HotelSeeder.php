<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Unit;
use Carbon\Carbon;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $pegawaiList = Pegawai::take(5)->get(); // Ambil 5 pegawai berbeda
        $unit = Unit::first();
        $user = User::first();

        if ($pegawaiList->count() < 5 || !$unit || !$user) {
            $this->command->warn("Seeder Hotel dilewati karena data pegawai/unit/user belum cukup.");
            return;
        }

        $namaHotels = [
            'Hotel Bintang 5 Medan', 'Hotel Permata Biru', 'Hotel Grand Sumatera',
            'Hotel Mawar Indah', 'Hotel Nusantara', 'Hotel Batang Kuis',
            'Hotel Danau Toba', 'Hotel Asri Sejuk', 'Hotel Palma Raya',
            'Hotel Cempaka Emas', 'Hotel Deli Indah', 'Hotel Rindu Alam',
            'Hotel Karya Nyata', 'Hotel Panorama', 'Hotel Bahagia'
        ];

        for ($i = 0; $i < 15; $i++) {
            Hotel::create([
                'pegawai_id' => $pegawaiList[$i % 5]->id,
                'unit_id' => $unit->id,
                'nama_hotel' => $namaHotels[$i],
                'biaya' => rand(400000, 850000),
                'tanggal_masuk' => Carbon::now()->addDays($i)->toDateString(),
                'tanggal_keluar' => Carbon::now()->addDays($i + 2)->toDateString(),
                'created_by' => $user->id,
            ]);
        }
    }
}
