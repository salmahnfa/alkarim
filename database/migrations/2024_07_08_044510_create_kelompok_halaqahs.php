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
        Schema::create('kelompok_halaqahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id');
            $table->foreignId('kelas_id');
            $table->enum('grade', ['A', 'B', 'C']);
            $table->foreignId('guru_quran_id')->nullable();
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('guru_quran_id')->references('id')->on('guru_qurans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_halaqahs');
    }
};
