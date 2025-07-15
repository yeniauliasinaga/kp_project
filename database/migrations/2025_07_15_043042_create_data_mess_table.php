<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_mess', function (Blueprint $table) {
            $table->id();
            $table->enum('lokasi', ['Berastagi', 'Parapat', 'Kapten Muslim', 'Auditor', 'Direksi']);
            $table->string('nomor_kamar');
            $table->integer('jumlah_bed');
            $table->enum('status', ['tersedia', 'terpakai'])->default('tersedia');
            $table->timestamps();

            $table->unique(['lokasi', 'nomor_kamar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mess');
    }
};
