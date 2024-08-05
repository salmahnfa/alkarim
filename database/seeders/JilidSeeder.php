<?php

namespace Database\Seeders;

use App\Models\Jilid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JilidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jilid::create([
            'nama' => 'Jilid PAUD',
            'deskripsi' => 'Mengenal huruf hijaiyah',
            'jml_hal' => 42,
            'file_path' => ''
        ]);
        
        Jilid::create([
            'nama' => 'Jilid 1',
            'deskripsi' => 'Harakat Fathah, Huruf Bersambung, Mad Thabi’i',
            'jml_hal' => 60,
            'file_path' => ''
        ]);

        Jilid::create([
            'nama' => 'Jilid 2',
            'deskripsi' => 'Harakat Kasrah, Harakat Dhammah, Tanwin, Sukun, Tasydid',
            'jml_hal' => 82,
            'file_path' => ''
        ]);

        Jilid::create([
            'nama' => 'Jilid 3',
            'deskripsi' => 'Ghunnah, Nun Sakinah atau Tanwin, Mim Sakinah, Hamzah Washal',
            'jml_hal' => 53,
            'file_path' => ''
        ]);

        Jilid::create([
            'nama' => 'Jilid 4',
            'deskripsi' => 'Waqaf, Idgham, Hukum Ra, Tanda Sifir, Kaidah Bacaan Khusus',
            'jml_hal' => 49,
            'file_path' => ''
        ]);

        Jilid::create([
            'nama' => 'Gharib Tajwid',
            'deskripsi' => 'Kaidah Bacaan Khusus, Tajwid, Nadzam',
            'jml_hal' => 76,
            'file_path' => ''
        ]);
    }
}
