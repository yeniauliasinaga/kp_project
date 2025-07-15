<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\TiketPesawat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TiketPesawatSeeder extends Seeder
{
    public function run()
    {
        $pegawai1 = Pegawai::first();
        $pegawai2 = Pegawai::find(2);
        $admin = User::whereHas('pegawai', fn($q) => $q->where('role', 'admin'))->first();
        $staff = User::whereHas('pegawai', fn($q) => $q->where('role', 'staff'))->first();

        if (!$pegawai1 || !$pegawai2 || !$admin || !$staff) {
            $this->command->warn("Seeder TiketPesawat: Data pegawai atau user belum tersedia.");
            return;
        }

        $tickets = [
            [
                'pegawai_id' => $pegawai1->id,
                'tujuan' => 'Jakarta',
                'tanggal' => Carbon::now()->addDays(7),
                'biaya' => 1500000,
                'created_by' => $admin->id
            ],
            [
                'pegawai_id' => $pegawai2->id,
                'tujuan' => 'Surabaya',
                'tanggal' => Carbon::now()->addDays(10),
                'biaya' => 1800000,
                'created_by' => $staff->id
            ],
        ];

        foreach ($tickets as $ticket) {
            TiketPesawat::create($ticket);
        }

        $this->command->info("Seeder TiketPesawat berhasil ditambahkan.");
    }
}
