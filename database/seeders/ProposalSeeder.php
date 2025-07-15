<?php

namespace Database\Seeders;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProposalSeeder extends Seeder
{
    public function run()
    {
        // Cari user berdasarkan role yang disimpan di tabel pegawai
        $admin = User::whereHas('pegawai', fn($q) => $q->where('role', 'admin'))->first();
        $staff = User::whereHas('pegawai', fn($q) => $q->where('role', 'staff'))->first();

        // Jika user tidak ditemukan, tampilkan peringatan
        if (!$admin || !$staff) {
            $this->command->warn("Seeder Proposal: Tidak menemukan user dengan role admin atau staff.");
            return;
        }

        $proposals = [
            [
                'nama_instansi' => 'Yayasan Pendidikan ABC',
                'disposisi' => 'disetujui',
                'nilai_bantuan' => 50000000,
                'tanggal_proposal' => now()->subDays(15),
                'deskripsi' => 'Permohonan bantuan untuk pembangunan sekolah',
                'created_by' => $admin->id,
            ],
            [
                'nama_instansi' => 'Komunitas Lingkungan Hijau',
                'disposisi' => 'tidak disetujui',
                'nilai_bantuan' => 25000000,
                'tanggal_proposal' => now()->subDays(7),
                'deskripsi' => 'Program penghijauan di sekitar pabrik',
                'created_by' => $staff->id,
            ],
        ];

        foreach ($proposals as $proposal) {
            Proposal::create($proposal);
        }
    }
}
