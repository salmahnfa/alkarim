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
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('unit_id');
            $table->foreignId('kelas_id');
            $table->enum('grade', ['A', 'B', 'C']);
            $table->foreignId('kelompok_halaqah_id')->nullable();
            $table->string('tahun_ajaran');

            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('kelompok_halaqah_id')->references('id')->on('kelompok_halaqahs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_kelas');
    }
};
