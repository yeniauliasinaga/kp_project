<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supir;

class SupirSeeder extends Seeder
{
    public function run()
    {
        $drivers = [
            ['nama_lengkap' => 'Budi Santoso', 'tanggal_lahir' => '1985-05-15', 'jenis_kelamin' => 'pria', 'no_telepon' => '081234567890', 'alamat' => 'Jl. Mawar No. 10, Medan', 'nik' => '1200123456789012', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Siti Aminah', 'tanggal_lahir' => '1990-08-20', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082345678901', 'alamat' => 'Jl. Melati No. 5, Medan', 'nik' => '1200987654321098', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Andi Pratama', 'tanggal_lahir' => '1987-12-10', 'jenis_kelamin' => 'pria', 'no_telepon' => '081345678912', 'alamat' => 'Jl. Kenanga No. 3, Medan', 'nik' => '1200234567890123', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Dewi Lestari', 'tanggal_lahir' => '1992-03-22', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082456789012', 'alamat' => 'Jl. Anggrek No. 7, Medan', 'nik' => '1200345678901234', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Rudi Hartono', 'tanggal_lahir' => '1989-07-05', 'jenis_kelamin' => 'pria', 'no_telepon' => '081456789023', 'alamat' => 'Jl. Dahlia No. 2, Medan', 'nik' => '1200456789012345', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Lina Marlina', 'tanggal_lahir' => '1991-11-18', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082567890123', 'alamat' => 'Jl. Cempaka No. 9, Medan', 'nik' => '1200567890123456', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Teguh Wijaya', 'tanggal_lahir' => '1986-02-14', 'jenis_kelamin' => 'pria', 'no_telepon' => '081567890134', 'alamat' => 'Jl. Flamboyan No. 1, Medan', 'nik' => '1200678901234567', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Rina Apriani', 'tanggal_lahir' => '1993-09-25', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082678901234', 'alamat' => 'Jl. Kamboja No. 6, Medan', 'nik' => '1200789012345678', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Ahmad Fauzi', 'tanggal_lahir' => '1988-06-30', 'jenis_kelamin' => 'pria', 'no_telepon' => '081678901245', 'alamat' => 'Jl. Teratai No. 11, Medan', 'nik' => '1200890123456789', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Melati Zahra', 'tanggal_lahir' => '1994-04-12', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082789012345', 'alamat' => 'Jl. Wijaya No. 4, Medan', 'nik' => '1200901234567890', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Fajar Setiawan', 'tanggal_lahir' => '1980-01-05', 'jenis_kelamin' => 'pria', 'no_telepon' => '081245678901', 'alamat' => 'Jl. Sakura No. 11, Medan', 'nik' => '1200912345678901', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Nur Aini', 'tanggal_lahir' => '1995-12-30', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082812345678', 'alamat' => 'Jl. Seruni No. 3, Medan', 'nik' => '1201023456789012', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Agus Salim', 'tanggal_lahir' => '1982-03-18', 'jenis_kelamin' => 'pria', 'no_telepon' => '081912345678', 'alamat' => 'Jl. Bahagia No. 2, Medan', 'nik' => '1201134567890123', 'status' => 'tersedia'],
            ['nama_lengkap' => 'Yuliana Fitri', 'tanggal_lahir' => '1987-08-11', 'jenis_kelamin' => 'wanita', 'no_telepon' => '082934567890', 'alamat' => 'Jl. Gaharu No. 8, Medan', 'nik' => '1201245678901234', 'status' => 'bertugas'],
            ['nama_lengkap' => 'Ilham Syahputra', 'tanggal_lahir' => '1984-07-22', 'jenis_kelamin' => 'pria', 'no_telepon' => '081823456789', 'alamat' => 'Jl. Kenari No. 12, Medan', 'nik' => '1201356789012345', 'status' => 'tersedia'],
        ];

        foreach ($drivers as $driver) {
            Supir::create($driver);
        }
    }
}
