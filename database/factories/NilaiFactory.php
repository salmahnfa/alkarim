<?php

namespace Database\Factories;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Ujian;
use App\Models\GuruQuran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nilai>
 */
class NilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $guru = GuruQuran::inRandomOrder()->first();

        return [
            'siswa_id' => Siswa::inRandomOrder()->first()->id,
            'ujian_id' => Ujian::inRandomOrder()->first()->id,
            'deskripsi' => 'Ujian ' . $this->faker->numberBetween(1, 10),
            'guru_quran_id' => $guru->id,
            'nilai' => fake()->numberBetween(0, 100),
            'tanggal_ujian' => fake()->dateTimeBetween('2024-01-01', '2024-07-18'),
            'unit_id' => $guru->unit_id,
        ];
    }
}
