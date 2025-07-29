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
        Schema::create('hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai');
            $table->string('nama_hotel');
            $table->foreignId('unit_id')->constrained('unit');
            $table->decimal('biaya', 12, 2);
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->string('bukti_resi')->comment('Nama file gambar di public/asset/img/hotel/');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};
