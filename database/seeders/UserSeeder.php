<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static $userMap = []; // Simpan email → ID mapping untuk PegawaiSeeder

    public function run(): void
    {
        $users = [
            ['name' => 'Dewi Kartika', 'email' => 'dewi.kartika@example.com'],
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@example.com'],
            ['name' => 'Sari Ayu', 'email' => 'sari.ayu@example.com'],
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@example.com'],
            ['name' => 'Rina Marlina', 'email' => 'rina.marlina@example.com'],
            ['name' => 'Teguh Prasetyo', 'email' => 'teguh.prasetyo@example.com'],
            ['name' => 'Lina Wulandari', 'email' => 'lina.wulandari@example.com'],

            // Staffs
            ['name' => 'Doni Saputra', 'email' => 'doni.saputra@example.com'],
            ['name' => 'Mega Putri', 'email' => 'mega.putri@example.com'],
            ['name' => 'Yusuf Hidayat', 'email' => 'yusuf.hidayat@example.com'],
            ['name' => 'Intan Permata', 'email' => 'intan.permata@example.com'],
            ['name' => 'Rizky Maulana', 'email' => 'rizky.maulana@example.com'],
            ['name' => 'Nadya Salsabila', 'email' => 'nadya.salsabila@example.com'],
        ];

        foreach ($users as $u) {
            $id = DB::table('users')->insertGetId([
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            self::$userMap[$u['name']] = $id;
        }
    }
}
