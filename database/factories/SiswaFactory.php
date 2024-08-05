<?php

namespace Database\Factories;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Unit;
use App\Models\KelompokHalaqah;
use App\Models\Surah;
use App\Models\Jilid;
use App\Models\GuruQuran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nisn' => fake()->numerify('##########'),
            'nama' => fake()->name(),
            'unit_id' => Unit::inRandomOrder()->first()->id,
            'kelas_id' => Kelas::inRandomOrder()->first()->id,
            'grade' => fake()->randomElement(['A', 'B', 'C']),
            'surah_id' => Surah::inRandomOrder()->first()->id,
            'jilid_id' => Jilid::inRandomOrder()->first()->id,
        ];
    }
}
