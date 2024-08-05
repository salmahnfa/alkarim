<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\KelompokHalaqah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = Siswa::factory()->count(100)->create();

        foreach ($siswas as $siswa) {
            $kelompokHalaqah = KelompokHalaqah::where('unit_id', $siswa->unit_id)
                ->where('kelas_id', $siswa->kelas_id)
                ->where('grade', $siswa->grade)
                ->first();

            if ($kelompokHalaqah) {
                $siswa->kelompok_halaqah_id = $kelompokHalaqah->id;
            }
    
            $siswa->save();
        }
    }
}
