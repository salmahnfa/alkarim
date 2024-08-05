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
        Schema::create('surahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_arab');
            $table->string('arti');
            $table->string('tipe');
            $table->integer('jml_ayat');
            $table->integer('durasi')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });

        Schema::create('juzs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->foreignId('surah_id_mulai');
            $table->integer('ayat_mulai');
            $table->foreignId('surah_id_selesai');
            $table->integer('ayat_selesai');
            $table->timestamps();

            $table->foreign('surah_id_mulai')->references('id')->on('surahs');
            $table->foreign('surah_id_selesai')->references('id')->on('surahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surahs');
        Schema::dropIfExists('juzs');
    }
};
