<?php

namespace Database\Seeders;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProposalSeeder extends Seeder
{
    public function run()
    {
        $superadmin = User::whereHas('pegawai', fn($q) => $q->where('role', 'superadmin'))->first();
        $staff = User::whereHas('pegawai', fn($q) => $q->where('role', 'staff'))->first();

        if (!$superadmin || !$staff) {
            $this->command->warn("Seeder Proposal: Tidak menemukan user dengan role superadmin atau staff.");
            return;
        }

        $instansis = [
            'Yayasan Pendidikan ABC', 'Komunitas Lingkungan Hijau', 'Lembaga Sosial Sejahtera',
            'Yayasan Anak Bangsa', 'Forum Masyarakat Adat', 'Perkumpulan Petani Mandiri',
            'Karang Taruna Muda', 'Badan Dakwah Islam', 'Lembaga Seni Budaya',
            'Yayasan Cinta Kasih', 'Asosiasi Nelayan Bahari', 'Komunitas Literasi Nusantara',
            'Paguyuban Wirausaha Tani', 'Yayasan Bina Remaja', 'Komunitas Hijau Lestari'
        ];

        foreach ($instansis as $i => $instansi) {
            Proposal::create([
                'nama_instansi' => $instansi,
                'disposisi' => $i % 2 === 0 ? 'disetujui' : 'tidak disetujui',
                'nilai_bantuan' => rand(5, 50) * 1000000,
                'tanggal_proposal' => now()->subDays(rand(5, 30)),
                'deskripsi' => 'Pengajuan proposal bantuan untuk kegiatan sosial di wilayah ' . Str::random(5),
                'created_by' => $i % 2 === 0 ? $superadmin->id : $staff->id,
            ]);
        }
    }
}
