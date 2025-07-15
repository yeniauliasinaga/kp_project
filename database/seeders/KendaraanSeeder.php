<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            [
                'no_polisi' => 'BK 1234 AB',
                'merek' => 'Toyota',
                'model' => 'Avanza',
                'bahan_bakar' => 'Bensin',
                'status_kepemilikan' => 'milik perusahaan',
                'status' => 'tersedia'
            ],
            [
                'no_polisi' => 'BK 5678 CD',
                'merek' => 'Daihatsu',
                'model' => 'Xenia',
                'bahan_bakar' => 'Bensin',
                'status_kepemilikan' => 'milik perusahaan',
                'status' => 'tersedia'
            ],
            [
                'no_polisi' => 'BK 9012 EF',
                'merek' => 'Mitsubishi',
                'model' => 'Pajero',
                'bahan_bakar' => 'Solar',
                'status_kepemilikan' => 'sewa',
                'status' => 'digunakan'
            ],
            [
                'no_polisi' => 'BK 2312 TF',
                'merek' => 'Mitsubishi',
                'model' => 'L300',
                'bahan_bakar' => 'Solar',
                'status_kepemilikan' => 'sewa',
                'status' => 'digunakan'
            ],
            [
                'no_polisi' => 'BK 2012 PE',
                'merek' => 'BMW',
                'model' => 'Super Car',
                'bahan_bakar' => 'Solar',
                'status_kepemilikan' => 'sewa',
                'status' => 'digunakan'
            ],
            [
                'no_polisi' => 'BK1234AA',
                'merek' => 'Toyota',
                'model' => 'Pajero',
                'bahan_bakar' => 'Solar',
                'status_kepemilikan' => 'milik perusahaan',
                'status' => 'digunakan'
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Kendaraan::create($vehicle);
        }
    }
}
