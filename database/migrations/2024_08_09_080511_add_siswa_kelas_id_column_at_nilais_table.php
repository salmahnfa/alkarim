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
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreignId('siswa_kelas_id')->nullable();
            $table->foreign('siswa_kelas_id')->references('id')->on('siswa_kelas');

            $table->dropForeign('nilais_siswa_id_foreign');
            $table->dropColumn('siswa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign('nilais_siswa_kelas_id_foreign');
            $table->dropColumn('siswa_kelas_id');

            $table->foreignId('siswa_id')->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswas');
        });
    }
};
