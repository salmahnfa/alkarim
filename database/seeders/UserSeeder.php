<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Unit;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitCount = Unit::count();

        for ($i = 0; $i < $unitCount; $i++) {
            User::create([
                'nama' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => static::$password ??= Hash::make('password'),
                'role_id' => 3,
                'remember_token' => Str::random(10)
            ]);
        }

        User::factory()->count(20)->create();
    }
}
