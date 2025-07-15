<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CheckinMess; // ⬅️ Tambahkan ini
use App\Models\User;
use App\Models\DataMess;

class CheckinMessSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $mess = DataMess::first();

        if (!$user || !$mess) return;

        CheckinMess::create([
            'mess_id' => $mess->id,
            'nama_tamu' => 'John Doe',
            'asal' => 'Jakarta',
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addDays(3),
            'biaya' => 250000,
            'created_by' => $user->id,
        ]);
    }
}
