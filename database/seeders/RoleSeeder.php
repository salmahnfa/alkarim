<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nama' => 'Administrator Pusat',
            'deskripsi' => '-'
        ]);

        Role::create([
            'nama' => 'PPQ',
            'deskripsi' => '-'
        ]);

        Role::create([
            'nama' => 'Administrator Unit',
            'deskripsi' => '-'
        ]);

        Role::create([
            'nama' => 'Guru Quran',
            'deskripsi' => '-'
        ]);
    }
}
