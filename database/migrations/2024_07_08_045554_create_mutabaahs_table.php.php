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
        Schema::create('mutabaahs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique;
            $table->foreignId('siswa_id');
            $table->json('ziyadah');
            $table->integer('murojaah');
            $table->json('tilawah');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas');
        });

        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('ujian_id');
            $table->string('deskripsi');
            $table->foreignId('guru_quran_id');
            $table->integer('nilai');
            $table->date('tanggal_ujian')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('ujian_id')->references('id')->on('ujians');
            $table->foreign('guru_quran_id')->references('id')->on('guru_qurans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutabaahs');
        Schema::dropIfExists('nilais');
    }
};