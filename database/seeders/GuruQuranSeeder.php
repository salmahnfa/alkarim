<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GuruQuran;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruQuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id', 4)->get();
        $units = Unit::all()->pluck('id');

        foreach ($users as $user) {
            $randomUnitId = $units->random();
            GuruQuran::create(['user_id' => $user->id, 'unit_id' => $randomUnitId]);
        }
    }
}
