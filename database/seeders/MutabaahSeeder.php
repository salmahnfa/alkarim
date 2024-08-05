<?php

namespace Database\Seeders;

use App\Models\Mutabaah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutabaahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mutabaah::factory()->count(30)->create();
    }
}
