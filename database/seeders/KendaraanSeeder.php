<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            ['id' => 1, 'no_polisi' => 'BK 1234 AB', 'merek' => 'Toyota', 'model' => 'Avanza', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'tersedia'],
            ['id' => 2, 'no_polisi' => 'BK 5678 CD', 'merek' => 'Daihatsu', 'model' => 'Xenia', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'tersedia'],
            ['id' => 3, 'no_polisi' => 'BK 9012 EF', 'merek' => 'Mitsubishi', 'model' => 'Pajero', 'bahan_bakar' => 'Solar', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
            ['id' => 4, 'no_polisi' => 'BK 2312 TF', 'merek' => 'Mitsubishi', 'model' => 'L300', 'bahan_bakar' => 'Solar', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
            ['id' => 5, 'no_polisi' => 'BK 2012 PE', 'merek' => 'BMW', 'model' => 'Super Car', 'bahan_bakar' => 'Solar', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
            ['id' => 6, 'no_polisi' => 'BK1234AA', 'merek' => 'Toyota', 'model' => 'Pajero', 'bahan_bakar' => 'Solar', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'digunakan'],
            ['id' => 7, 'no_polisi' => 'BK 4567 GH', 'merek' => 'Honda', 'model' => 'Mobilio', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'sewa', 'status' => 'tersedia'],
            ['id' => 8, 'no_polisi' => 'BK 6789 IJ', 'merek' => 'Suzuki', 'model' => 'Ertiga', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'tersedia'],
            ['id' => 9, 'no_polisi' => 'BK 1011 KL', 'merek' => 'Nissan', 'model' => 'Grand Livina', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
            ['id' => 10, 'no_polisi' => 'BK 1213 MN', 'merek' => 'Kia', 'model' => 'Rio', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'tersedia'],
            ['id' => 11, 'no_polisi' => 'BK 1415 OP', 'merek' => 'Ford', 'model' => 'Everest', 'bahan_bakar' => 'Solar', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
            ['id' => 12, 'no_polisi' => 'BK 1617 QR', 'merek' => 'Chevrolet', 'model' => 'Spin', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'tersedia'],
            ['id' => 13, 'no_polisi' => 'BK 1819 ST', 'merek' => 'Hyundai', 'model' => 'Stargazer', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
            ['id' => 14, 'no_polisi' => 'BK 2021 UV', 'merek' => 'Mazda', 'model' => 'CX-5', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'milik perusahaan', 'status' => 'tersedia'],
            ['id' => 15, 'no_polisi' => 'BK 2223 WX', 'merek' => 'Wuling', 'model' => 'Confero', 'bahan_bakar' => 'Bensin', 'status_kepemilikan' => 'sewa', 'status' => 'digunakan'],
        ];

        foreach ($vehicles as $vehicle) {
            Kendaraan::create($vehicle);
        }
    }
}
