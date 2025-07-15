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
        Schema::create('permintaan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supir_id')->constrained('supir');
            $table->string('no_polisi');
            $table->enum('status_kepemilikan', ['milik perusahaan', 'sewa']);
            $table->date('jadwal_berangkat');
            $table->date('jadwal_pulang');
            $table->enum('tujuan', ['dalam wilayah', 'luar wilayah']);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();

            $table->foreign('no_polisi')->references('no_polisi')->on('kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_kendaraan');
    }
};
