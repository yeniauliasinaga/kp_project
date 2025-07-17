<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use App\Models\User;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $units = DB::table('unit')->get();

        if ($units->isEmpty()) {
            $this->command->warn("Tidak ada unit. Seeder Pegawai dilewati.");
            return;
        }

        // Superadmin
        $superadminEmail = 'dewi.kartika@example.com';
        $superadminUser = User::where('email', $superadminEmail)->first();

        if (!$superadminUser) {
            $this->command->warn("User dengan email $superadminEmail tidak ditemukan. Seeder Pegawai dilewati.");
            return;
        }

        Pegawai::firstOrCreate(
            ['nip' => '197805152005122001'],
            [
                'user_id' => $superadminUser->id,
                'nama'    => 'Dewi Kartika',
                'jabatan' => 'Kepala Bidang',
                'role'    => 'superadmin',
                'unit_id' => $units->first()->id,
                'alamat'  => 'Jl. Merdeka No. 1',
            ]
        );

        $staffs = [
            'Doni Saputra', 'Mega Putri', 'Yusuf Hidayat', 'Intan Permata',
            'Rizky Maulana', 'Nadya Salsabila', 'Budi Santoso', 'Sari Ayu',
            'Ahmad Fauzi', 'Rina Marlina', 'Teguh Prasetyo', 'Lina Wulandari'
        ];

        foreach ($units as $i => $unit) {
            foreach ($staffs as $j => $staffName) {
                $nip = '19910107201411' . sprintf('%03d', $i * 10 + $j);

                $email = strtolower(str_replace(' ', '.', $staffName)) . '@example.com';
                $user = User::where('email', $email)->first();

                if (!$user) {
                    $this->command->warn("User untuk $staffName tidak ditemukan.");
                    continue;
                }

                Pegawai::firstOrCreate(
                    ['nip' => $nip],
                    [
                        'user_id' => $user->id,
                        'nama'    => $staffName,
                        'jabatan' => 'Pegawai',
                        'role'    => 'staff',
                        'unit_id' => $unit->id,
                        'alamat'  => 'Jl. Unit ' . $unit->nama_unit,
                    ]
                );
            }
        }
    }
}
