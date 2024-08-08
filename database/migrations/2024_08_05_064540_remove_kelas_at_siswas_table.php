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
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign('siswas_unit_id_foreign');
            $table->dropForeign('siswas_kelas_id_foreign');
            $table->dropForeign('siswas_kelompok_halaqah_id_foreign');
            $table->dropColumn(['unit_id', 'kelas_id', 'grade', 'kelompok_halaqah_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('kelas_id')->nullable();
            $table->enum('grade', ['A', 'B', 'C'])->nullable();
            $table->foreignId('kelompok_halaqah_id')->nullable();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('kelompok_halaqah_id')->references('id')->on('kelompok_halaqahs');
        });
    }
};
