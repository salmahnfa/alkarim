<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminUnit;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id', 3)->get();
        $units = Unit::all();

        foreach ($units as $unit) {
            $user = $users->shift(); // Get the first user and remove it from the collection
            AdminUnit::create(['user_id' => $user->id, 'unit_id' => $unit->id]);
        }

        $remainingUsers = $users->all();
        $unitIds = $units->pluck('id');

        foreach ($remainingUsers as $user) {
            $randomUnitId = $unitIds->random();
            AdminUnit::create(['user_id' => $user->id, 'unit_id' => $randomUnitId]);
        }
    }
}
