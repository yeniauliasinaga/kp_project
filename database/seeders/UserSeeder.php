<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static array $userMap = [];

    public function run(): void
    {
        // Format: email => [nama, password]
        $users = [
            'dewi.kartika@example.com' => ['Dewi Kartika', 'password123'],
            'doni.saputra@example.com' => ['Doni Saputra', 'doni123'],
            'mega.putri@example.com' => ['Mega Putri', 'mega123'],
            'yusuf.hidayat@example.com' => ['Yusuf Hidayat', 'yusuf123'],
            'intan.permata@example.com' => ['Intan Permata', 'intan123'],
            'rizky.maulana@example.com' => ['Rizky Maulana', 'rizky123'],
            'nadya.salsabila@example.com' => ['Nadya Salsabila', 'nadya123'],
            'budi.santoso@example.com' => ['Budi Santoso', 'budi123'],
            'sari.ayu@example.com' => ['Sari Ayu', 'sari123'],
            'ahmad.fauzi@example.com' => ['Ahmad Fauzi', 'ahmad123'],
            'rina.marlina@example.com' => ['Rina Marlina', 'rina123'],
            'teguh.prasetyo@example.com' => ['Teguh Prasetyo', 'teguh123'],
            'lina.wulandari@example.com' => ['Lina Wulandari', 'superadmin123'], // ini superadmin
        ];

        foreach ($users as $email => [$name, $password]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['password' => Hash::make($password)]
            );

            self::$userMap[$name] = $user->id;
        }
    }
}
