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
        Schema::table('kelompok_halaqahs', function (Blueprint $table) {
            $table->string('tahun_ajaran')->nullable();
        });
        Schema::table('mutabaahs', function (Blueprint $table) {
            $table->string('tahun_ajaran')->nullable();
        });
        Schema::table('nilais', function (Blueprint $table) {
            $table->string('tahun_ajaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelompok_halaqahs', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
        });
        Schema::table('mutabaahs', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
        });
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
        });
    }
};
