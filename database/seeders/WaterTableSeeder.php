<?php

namespace Database\Seeders;

use App\Models\Water;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Water::create([
            'name' => 'Water',
            'calories' => 0,
            'protein' => 0,
            'carbs' => 0,
            'fat' => 0
        ]);
        Water::create([
            'name' => 'Milk (Whole)',
            'calories' => 65,
            'protein' => 3.2,
            'carbs' => 4.7,
            'fat' => 3.6
        ]);
        Water::create([
            'name' => 'Orange Juice',
            'calories' => 45,
            'protein' => 0.7,
            'carbs' => 10.4,
            'fat' => 0.2
        ]);
        Water::create([
            'name' => 'Milk (Skimmed)',
            'calories' => 35,
            'protein' => 3.6,
            'carbs' => 5,
            'fat' => 0.1
        ]);

    }
}
