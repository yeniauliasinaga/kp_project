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
        Schema::create('kegiatan', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kegiatan');
        $table->string('tempat');
        $table->decimal('biaya', 12, 2);
        $table->timestamp('waktu_mulai');
        $table->timestamp('waktu_selesai');
        $table->string('gambar')->comment('Nama file gambar di public/asset/img/kegiatan/');
        $table->enum('status', ['akan_datang', 'berlangsung', 'selesai'])->default('akan_datang');
        $table->foreignId('created_by')->constrained('users');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
