<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Food;
class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([
            'name' => 'Apple',
            'meal_type'=>'breakfast',
            'calories' => 95,
            'protein' => 0,
            'carbs' => 25,
            'fat' => 0,
            'portion' => 100
        ]);

        Food::create([
            'name' => 'Banana',
            'calories' => 105,
            'meal_type'=>'breakfast',
            'protein' => 1,
            'carbs' => 27,
            'fat' => 0,
            'portion' => 100
        ]);

        Food::create([
            'name' => 'Chicken Breast',
            'meal_type'=>'lunch',
            'calories' => 165,
            'protein' => 31,
            'carbs' => 0,
            'fat' => 3,
            'portion' => 100
        ]);

        Food::create([
            'name' => 'Mushrrom Curry',
            'meal_type'=>'dinner',
            'calories' => 106,
            'protein' => 10,
            'carbs' => 50,
            'fat' => 20,
            'portion' => 100
        ]);

    }
}
