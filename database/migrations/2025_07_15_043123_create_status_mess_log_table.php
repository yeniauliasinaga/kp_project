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
        Schema::create('status_mess_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mess_id')->constrained('data_mess');
            $table->enum('status', ['tersedia', 'terpakai']);
            $table->timestamp('waktu_perubahan')->useCurrent();
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_mess_log');
    }
};
