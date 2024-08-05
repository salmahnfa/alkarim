<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(JilidSeeder::class);
        $this->call(SurahSeeder::class);
        $this->call(UjianSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminUnitSeeder::class);
        $this->call(GuruQuranSeeder::class);
        $this->call(KelompokHalaqahSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(NilaiSeeder::class);
        $this->call(MutabaahSeeder::class);   
    }
}
