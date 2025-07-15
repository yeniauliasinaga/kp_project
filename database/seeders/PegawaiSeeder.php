<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Database\Seeders\UserSeeder;

class PegawaiSeeder extends Seeder
{
    public function run(): void
{
    $units = DB::table('unit')->get();

    // Superadmin
    DB::table('pegawai')->insert([
        'user_id' => UserSeeder::$userMap['Dewi Kartika'],
        'nama'    => 'Dewi Kartika',
        'nip'     => '197805152005122001',
        'jabatan' => 'Kepala Bidang',
        'role'    => 'superadmin',
        'unit_id' => $units->first()->id,
        'alamat'  => 'Jl. Merdeka No. 1',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $admins = ['Budi Santoso', 'Sari Ayu', 'Ahmad Fauzi', 'Rina Marlina', 'Teguh Prasetyo', 'Lina Wulandari'];
    $staffs = ['Doni Saputra', 'Mega Putri', 'Yusuf Hidayat', 'Intan Permata', 'Rizky Maulana', 'Nadya Salsabila'];

    foreach ($units as $i => $unit) {
        // Admin per unit
        DB::table('pegawai')->insert([
            'user_id' => UserSeeder::$userMap[$admins[$i]],
            'nama'    => $admins[$i],
            'nip'     => '19900101201011' . sprintf('%03d', $i),
            'jabatan' => 'Wakil Kepala Bidang',
            'role'    => 'admin',
            'unit_id' => $unit->id,
            'alamat'  => 'Jl. Unit ' . $unit->nama_unit,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Staff per unit
        foreach ($staffs as $j => $staffName) {
            DB::table('pegawai')->insert([
                'user_id' => UserSeeder::$userMap[$staffName],
                'nama'    => $staffName,
                'nip'     => '19910107201411' . sprintf('%03d', $i * 10 + $j),
                'jabatan' => 'Pegawai',
                'role'    => 'staff',
                'unit_id' => $unit->id,
                'alamat'  => 'Jl. Unit ' . $unit->nama_unit,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
}
