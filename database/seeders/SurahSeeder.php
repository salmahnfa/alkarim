<?php

namespace Database\Seeders;

use App\Models\Surah;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Surah::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $csvFile = fopen(base_path("database/data/surahs.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";"))!== FALSE) {
            if (!$firstline) {
                Surah::create([
                    "nama" => $data[0],
                    "nama_arab" => $data[1],
                    "arti" => $data[2],
                    "tipe" => $data[3],
                    "jml_ayat" => $data[4],
                    "durasi" => $data[5],
                    "file_path" => $data[6]
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
