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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->string('no_polisi', 15)->primary();
            $table->string('merek');
            $table->string('model');
            $table->string('bahan_bakar');
            $table->enum('status_kepemilikan', ['milik perusahaan', 'sewa']);
            $table->enum('status', ['tersedia', 'digunakan'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
