<?php

namespace Database\Factories;

use App\Models\Mutabaah;
use App\Models\Siswa;
use App\Models\Surah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mutabaah>
 */
class MutabaahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => fake()->dateTimeBetween('2024-01-01', '2024-07-18'),
            'siswa_id' => Siswa::inRandomOrder()->first()->id,
            'ziyadah' => json_encode([
                'surah_mulai_id' => Surah::inRandomOrder()->first()->id, 
                'ayat_mulai' => fake()->numberBetween(0, 100), 
                'surah_selesai_id' => Surah::inRandomOrder()->first()->id, 
                'ayat_selesai' => fake()->numberBetween(0, 100)
            ]),
            'murojaah' => fake()->numberBetween(0, 1000),
            'tilawah' => json_encode([
                'surah_mulai_id' => Surah::inRandomOrder()->first()->id, 
                'ayat_mulai' => fake()->numberBetween(0, 100), 
                'surah_selesai_id' => Surah::inRandomOrder()->first()->id, 
                'ayat_selesai' => fake()->numberBetween(0, 100)
            ])
        ];
    }
}
