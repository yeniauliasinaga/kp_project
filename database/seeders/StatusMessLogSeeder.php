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
        $messList = DataMess::all();

        if (!$user || $messList->isEmpty()) {
            $this->command->warn("User atau Data Mess belum tersedia. Seeder StatusMessLog dilewati.");
            return;
        }

        foreach ($messList as $mess) {
            StatusMessLog::create([
                'mess_id' => $mess->id,
                'status' => $mess->status ?? 'tersedia',
                'waktu_perubahan' => now(),
                'keterangan' => 'Status awal mess',
                'created_by' => $user->id,
            ]);
        }

        $this->command->info("✅ StatusMessLogSeeder berhasil dijalankan.");
    }
}
