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
        Schema::create('checkin_mess', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('mess_id')->constrained('data_mess');
            $table->string('nama_tamu');
            $table->string('asal');
            $table->date('waktu_mulai');
            $table->date('waktu_selesai');
            $table->decimal('biaya', 12, 2);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin_mess');
    }
};
