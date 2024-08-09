<?php

namespace Database\Seeders;

use App\Models\KelompokHalaqah;
use App\Models\Kelas;
use App\Models\Unit;
use App\Models\GuruQuran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokHalaqahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = Unit::all();
        $grades = ['A', 'B', 'C'];

        foreach ($units as $unit) {
            $kelas = Kelas::where('unit_id', $unit->id)->get();

            foreach ($kelas as $kelasItem) {
                foreach ($grades as $grade) {
                    KelompokHalaqah::create([
                        'unit_id' => $unit->id,
                        'kelas_id' => $kelasItem->id,
                        'grade' => $grade,
                    ]);
                }
            }
        }

        $kelompokHalaqahs = KelompokHalaqah::all();
        $guruQuranAssignmentCounts = [];

        $guruQurans = GuruQuran::whereIn('unit_id', $kelompokHalaqahs->pluck('unit_id')->unique())->inRandomOrder()->get();

        foreach ($kelompokHalaqahs as $kelompokHalaqah) {
            foreach ($guruQurans as $guruQuran) {
                if ($guruQuran->unit_id == $kelompokHalaqah->unit_id) {
                    $guruQuranId = $guruQuran->id;
                    $guruQuranAssignmentCounts[$guruQuranId] = $guruQuranAssignmentCounts[$guruQuranId] ?? 0;

                    if ($guruQuranAssignmentCounts[$guruQuranId] < 10) {
                        $kelompokHalaqah->update([
                            'guru_quran_id' => $guruQuranId,
                        ]);
                        $guruQuranAssignmentCounts[$guruQuranId]++;
                        break;
                    }
                }
            }
        }
    }
}
