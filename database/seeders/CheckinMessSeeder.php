<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CheckinMess;
use App\Models\User;
use App\Models\DataMess;

class CheckinMessSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $messes = DataMess::take(15)->get();

        if (!$user || $messes->isEmpty()) {
            $this->command->warn("CheckinMessSeeder: User atau Mess tidak tersedia.");
            return;
        }

        $asalList = ['Medan', 'Jakarta', 'Bandung', 'Padang', 'Aceh', 'Pekanbaru', 'Palembang'];

        for ($i = 0; $i < 15; $i++) {
            CheckinMess::create([
                'mess_id' => $messes[$i % $messes->count()]->id,
                'nama_tamu' => 'Tamu ' . chr(65 + $i),
                'asal' => $asalList[$i % count($asalList)],
                'waktu_mulai' => now()->addDays($i),
                'waktu_selesai' => now()->addDays($i + 2),
                'biaya' => rand(150000, 350000),
                'created_by' => $user->id,
            ]);
        }
    }
}
