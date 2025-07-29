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
        $pegawaiList = Pegawai::take(5)->get();
        $unit = Unit::first();
        $user = User::first();

        if ($pegawaiList->count() < 5 || !$unit || !$user) {
            $this->command->warn("Seeder Hotel dilewati karena data pegawai/unit/user belum cukup.");
            return;
        }

        $kotaTujuan = [
            'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Padang',
            'Palembang', 'Makassar', 'Balikpapan', 'Batam', 'Bali'
        ];

        $dummyFilePath = 'asset/img/hotel/contoh.jpg';
        $publicPath = public_path($dummyFilePath);

        if (!file_exists($publicPath)) {
            $this->command->warn("Seeder Hotel dilewati karena file gambar tidak ditemukan: $publicPath");
            return;
        }

        for ($i = 0; $i < 15; $i++) {
            $kota = $kotaTujuan[array_rand($kotaTujuan)];

            Hotel::create([
                'pegawai_id'     => $pegawaiList[$i % 5]->id,
                'unit_id'        => $unit->id,
                'nama_hotel'     => "Hotel $kota Indah",
                'biaya'          => rand(400000, 850000),
                'tanggal_masuk'  => Carbon::now()->addDays($i)->toDateString(),
                'tanggal_keluar' => Carbon::now()->addDays($i + 2)->toDateString(),
                'bukti_resi'     => $dummyFilePath, // langsung ambil dari public
                'created_by'     => $user->id,
            ]);
        }
    }
}
