<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\TiketPesawat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TiketPesawatSeeder extends Seeder
{
    public function run()
    {
        $kotaTujuan = [
            'Jakarta', 'Surabaya', 'Bandung', 'Yogyakarta', 'Denpasar',
            'Palembang', 'Balikpapan', 'Makassar', 'Semarang', 'Pekanbaru'
        ];

        $data = [
            ['pegawai_id' => 7, 'tanggal' => '2025-07-21', 'biaya' => 839995, 'created_by' => 7],
            ['pegawai_id' => 8, 'tanggal' => '2025-07-31', 'biaya' => 1152435, 'created_by' => 13],
            ['pegawai_id' => 10, 'tanggal' => '2025-08-15', 'biaya' => 1710174, 'created_by' => 3],
            ['pegawai_id' => 12, 'tanggal' => '2025-08-06', 'biaya' => 1906859, 'created_by' => 11],
            ['pegawai_id' => 13, 'tanggal' => '2025-08-01', 'biaya' => 1866318, 'created_by' => 12],
            ['pegawai_id' => 12, 'tanggal' => '2025-08-02', 'biaya' => 1203433, 'created_by' => 13],
            ['pegawai_id' => 8, 'tanggal' => '2025-07-31', 'biaya' => 1076931, 'created_by' => 9],
            ['pegawai_id' => 5, 'tanggal' => '2025-08-12', 'biaya' => 1309127, 'created_by' => 4],
            ['pegawai_id' => 9, 'tanggal' => '2025-07-31', 'biaya' => 1362121, 'created_by' => 6],
            ['pegawai_id' => 13, 'tanggal' => '2025-07-24', 'biaya' => 715339, 'created_by' => 12],
            ['pegawai_id' => 4, 'tanggal' => '2025-07-23', 'biaya' => 1806037, 'created_by' => 10],
            ['pegawai_id' => 5, 'tanggal' => '2025-08-14', 'biaya' => 965477, 'created_by' => 1],
            ['pegawai_id' => 2, 'tanggal' => '2025-07-17', 'biaya' => 593506, 'created_by' => 5],
            ['pegawai_id' => 10, 'tanggal' => '2025-08-08', 'biaya' => 1089398, 'created_by' => 8],
            ['pegawai_id' => 5, 'tanggal' => '2025-07-27', 'biaya' => 1829605, 'created_by' => 6],
        ];

        foreach ($data as $item) {
            $pegawai = Pegawai::find($item['pegawai_id']);
            $user = User::find($item['created_by']);

            if (!$pegawai || !$user) {
                echo "❌ TiketPesawatSeeder: Lewati data, pegawai_id {$item['pegawai_id']} atau created_by {$item['created_by']} tidak ditemukan.\n";
                continue;
            }

            // Ambil kota tujuan secara random
            $tujuan = fake()->randomElement($kotaTujuan);

            // Path resi dummy
            $resiPath = 'asset/img/tiket/contoh.jpg';

            if (!File::exists(public_path($resiPath))) {
                echo "⚠️ File resi tidak ditemukan: {$resiPath}, pastikan file contoh.jpg sudah ada di folder public/asset/img/tiket\n";
            }

            TiketPesawat::create([
                'pegawai_id' => $pegawai->id,
                'tujuan'     => $tujuan,
                'tanggal'    => $item['tanggal'],
                'biaya'      => $item['biaya'],
                'resi'       => $resiPath,
                'created_by' => $user->id,
            ]);
        }
    }
}
