<?php

namespace Database\Seeders;

use App\Models\DataMess;
use Illuminate\Database\Seeder;

class DataMessSeeder extends Seeder
{
    public function run()
    {
        $locations = ['Berastagi', 'Parapat', 'Kapten Muslim', 'Auditor', 'Direksi'];

        foreach ($locations as $location) {
            $roomCount = $location === 'Direksi' ? 5 : 10; // Fewer rooms for Direksi

            for ($i = 1; $i <= $roomCount; $i++) {
                DataMess::create([
                    'lokasi' => $location,
                    'nomor_kamar' => str_pad($i, 2, '0', STR_PAD_LEFT),
                    'jumlah_bed' => $location === 'Direksi' ? 1 : 2,
                    'status' => $i % 3 === 0 ? 'terpakai' : 'tersedia' // 1/3 rooms occupied
                ]);
            }
        }
    }
}
