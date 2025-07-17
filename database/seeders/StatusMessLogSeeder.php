<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusMessLog;
use App\Models\DataMess;
use App\Models\User;

class StatusMessLogSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $messes = DataMess::all();

        if (!$user || $messes->isEmpty()) {
            $this->command->warn("StatusMessLogSeeder: User atau DataMess tidak tersedia.");
            return;
        }

        for ($i = 0; $i < 15; $i++) {
            $mess = $messes[$i % $messes->count()];
            StatusMessLog::create([
                'mess_id' => $mess->id,
                'status' => $mess->status,
                'keterangan' => 'Log status mess ke-' . ($i + 1),
                'waktu_perubahan' => now()->addMinutes($i * 10),
                'created_by' => $user->id,
            ]);
        }
    }
}
