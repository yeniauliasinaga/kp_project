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
        Schema::create('status_kendaraan_log', function (Blueprint $table) {
           $table->id();
            $table->string('no_polisi');
            $table->enum('status', ['tersedia', 'digunakan']);
            $table->timestamp('waktu_perubahan')->useCurrent();
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->constrained('users');

            $table->foreign('no_polisi')->references('no_polisi')->on('kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_kendaraan_log');
    }
};
