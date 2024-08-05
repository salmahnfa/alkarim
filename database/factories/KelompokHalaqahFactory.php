<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Unit;
use App\Models\KelompokHalaqah;
use App\Models\GuruQuran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KelompokHalaqah>
 */
class KelompokHalaqahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {       
        return [
            'unit_id' => Unit::inRandomOrder()->first()->id,
            'kelas_id' => Kelas::inRandomOrder()->first()->id,
            'grade' => fake()->randomElement(['A', 'B', 'C']),
            'guru_quran_id' => GuruQuran::inRandomOrder()->first()->id,
        ];
    }
}
