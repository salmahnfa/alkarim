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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->nullable();
            $table->string('nama');
            $table->foreignId('unit_id');
            $table->foreignId('kelas_id');
            $table->enum('grade', ['A', 'B', 'C']);
            $table->foreignId('kelompok_halaqah_id')->nullable();
            $table->foreignId('surah_id');
            $table->foreignId('jilid_id');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('kelompok_halaqah_id')->references('id')->on('kelompok_halaqahs');
            $table->foreign('surah_id')->references('id')->on('surahs');
            $table->foreign('jilid_id')->references('id')->on('jilids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
