<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasNames = [];
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 0; $j < 2; $j++) {
                $kelasNames[] = $i . chr(65 + $j);
            }
        }

        foreach ($kelasNames as $nama) {
            Kelas::create(['nama' => $nama]);
        }
    }
}
