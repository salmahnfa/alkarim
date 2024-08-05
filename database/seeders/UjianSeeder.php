<?php

namespace Database\Seeders;

use App\Models\Ujian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ujian::create([
            'nama' => 'Tahsin',
            'deskripsi' => 'Ujian membaca Alquran'
        ]);

        Ujian::create([
            'nama' => 'Tasmi',
            'deskripsi' => 'Ujian tasmi juziyyah'
        ]);

        Ujian::create([
            'nama' => 'Tahfidz',
            'deskripsi' => 'Ujian tahfidz'
        ]);
    }
}
