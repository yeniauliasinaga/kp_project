<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['nama_unit' => 'PTI'],
            ['nama_unit' => 'SDM'],
            ['nama_unit' => 'AKN'],
            ['nama_unit' => 'TAN'],
            ['nama_unit' => 'TEP'],
            ['nama_unit' => 'SKH'],
        ];

        DB::table('unit')->insert($units);
    }
}
