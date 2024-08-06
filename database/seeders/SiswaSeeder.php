<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KelompokHalaqah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Date::now();
        $siswas = Siswa::factory()->count(100)->create();

        foreach ($siswas as $siswa) {
            $kelas = Kelas::inRandomOrder()->first();
            $grade = fake()->randomElement(['A', 'B', 'C']);

            $kelompokHalaqah = KelompokHalaqah::where('kelas_id', $kelas->id)
                ->where('grade', $grade)
                ->first();

            if (!$kelompokHalaqah) {
                $kelompokHalaqah = ['id' => null];
            }

            $siswa->save();

            $siswa->kelas()->attach($kelas->id, [
                'grade' => $grade,
                'unit_id' => $kelas->unit_id,
                'kelompok_halaqah_id' => $kelompokHalaqah->id,
                'tahun_ajaran' => '2024/2025',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
