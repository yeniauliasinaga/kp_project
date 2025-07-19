<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id(); // Ini akan membuat kolom id AUTO_INCREMENT dan menjadi primary key
            $table->string('no_polisi', 15)->unique(); // Tetap unik, tapi bukan primary key
            $table->string('merek');
            $table->string('model');
            $table->string('bahan_bakar');
            $table->enum('status_kepemilikan', ['milik perusahaan', 'sewa']);
            $table->enum('status', ['tersedia', 'digunakan'])->default('tersedia');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
