<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([
            'name' => 'Apple',
            'calories' => 95,
            'protein' => 0,
            'carbs' => 25,
            'fat' => 0
        ]);

        Food::create([
            'name' => 'Banana',
            'calories' => 105,
            'protein' => 1,
            'carbs' => 27,
            'fat' => 0
        ]);

        Food::create([
            'name' => 'Chicken Breast',
            'calories' => 165,
            'protein' => 31,
            'carbs' => 0,
            'fat' => 3
        ]);

    }
}
