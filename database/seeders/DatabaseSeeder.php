<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    $this->call([
        UnitSeeder::class,
        UserSeeder::class,
        PegawaiSeeder::class,
        KendaraanSeeder::class,
        StatusKendaraanLogSeeder::class,
        SupirSeeder::class,
        DataMessSeeder::class,
        CheckinMessSeeder::class,
        HotelSeeder::class,
        BeritaSeeder::class,
        ProposalSeeder::class,
        PermintaanKendaraanSeeder::class,
        TiketPesawatSeeder::class,
    ]);
}
}