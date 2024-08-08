<?php

namespace Database\Seeders;

use App\Models\KelompokHalaqah;
use App\Models\Mutabaah;
use App\Models\Nilai;
use App\Models\Ujian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KelompokHalaqah::whereNull('tahun_ajaran')->update(['tahun_ajaran' => '2024/2025']);
        Mutabaah::whereNull('tahun_ajaran')->update(['tahun_ajaran' => '2024/2025']);
        Nilai::whereNull('tahun_ajaran')->update(['tahun_ajaran' => '2024/2025']);
    }
}
