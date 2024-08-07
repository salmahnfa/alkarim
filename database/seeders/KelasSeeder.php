<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataKelas = [];
        $unitIds = Unit::all()->pluck('id')->toArray();
        foreach ($unitIds as $unitId) {
            for ($i = 1; $i <= 3; $i++) {
                for ($j = 0; $j < 2; $j++) {
                    $dataKelas[] = [
                        'nama' =>  $i . chr(65 + $j),
                        'unit_id' => $unitId
                    ];

                }
            }
        }

        foreach ($dataKelas as $kelas) {
            Kelas::create($kelas);
        }
    }
}
