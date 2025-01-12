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
        'meal_type' => 'breakfast',
        'calories' => 95,
        'protein' => 0,
        'carbs' => 25,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Banana',
        'meal_type' => 'breakfast',
        'calories' => 105,
        'protein' => 1,
        'carbs' => 27,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Chicken Breast',
        'meal_type' => 'lunch',
        'calories' => 165,
        'protein' => 31,
        'carbs' => 0,
        'fat' => 3,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Mushroom Curry',
        'meal_type' => 'dinner',
        'calories' => 106,
        'protein' => 10,
        'carbs' => 50,
        'fat' => 20,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Almonds',
        'meal_type' => 'snack',
        'calories' => 576,
        'protein' => 21,
        'carbs' => 22,
        'fat' => 49,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Salmon',
        'meal_type' => 'lunch',
        'calories' => 208,
        'protein' => 20,
        'carbs' => 0,
        'fat' => 13,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Greek Yogurt',
        'meal_type' => 'breakfast',
        'calories' => 59,
        'protein' => 10,
        'carbs' => 3,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Oatmeal',
        'meal_type' => 'breakfast',
        'calories' => 150,
        'protein' => 5,
        'carbs' => 27,
        'fat' => 3,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Broccoli',
        'meal_type' => 'dinner',
        'calories' => 55,
        'protein' => 4,
        'carbs' => 11,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Eggs',
        'meal_type' => 'breakfast',
        'calories' => 155,
        'protein' => 13,
        'carbs' => 1,
        'fat' => 11,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Rice',
        'meal_type' => 'lunch',
        'calories' => 130,
        'protein' => 2,
        'carbs' => 28,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Tofu',
        'meal_type' => 'lunch',
        'calories' => 144,
        'protein' => 16,
        'carbs' => 3,
        'fat' => 8,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Peanut Butter',
        'meal_type' => 'snack',
        'calories' => 588,
        'protein' => 25,
        'carbs' => 20,
        'fat' => 50,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Sweet Potato',
        'meal_type' => 'lunch',
        'calories' => 86,
        'protein' => 2,
        'carbs' => 20,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Lentil Soup',
        'meal_type' => 'dinner',
        'calories' => 116,
        'protein' => 9,
        'carbs' => 20,
        'fat' => 2,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Cheddar Cheese',
        'meal_type' => 'snack',
        'calories' => 403,
        'protein' => 25,
        'carbs' => 1,
        'fat' => 33,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Orange',
        'meal_type' => 'breakfast',
        'calories' => 62,
        'protein' => 1,
        'carbs' => 15,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Spinach',
        'meal_type' => 'dinner',
        'calories' => 23,
        'protein' => 3,
        'carbs' => 4,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Avocado',
        'meal_type' => 'lunch',
        'calories' => 160,
        'protein' => 2,
        'carbs' => 9,
        'fat' => 15,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Beef Steak',
        'meal_type' => 'dinner',
        'calories' => 271,
        'protein' => 25,
        'carbs' => 0,
        'fat' => 19,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Carrots',
        'meal_type' => 'snack',
        'calories' => 41,
        'protein' => 1,
        'carbs' => 10,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Pasta',
        'meal_type' => 'lunch',
        'calories' => 131,
        'protein' => 5,
        'carbs' => 25,
        'fat' => 1,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Blueberries',
        'meal_type' => 'breakfast',
        'calories' => 57,
        'protein' => 1,
        'carbs' => 14,
        'fat' => 0,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Dark Chocolate',
        'meal_type' => 'snack',
        'calories' => 546,
        'protein' => 5,
        'carbs' => 46,
        'fat' => 31,
        'portion' => 100,
    ]);
    
    Food::create([
        'name' => 'Turkey Breast',
        'meal_type' => 'lunch',
        'calories' => 135,
        'protein' => 30,
        'carbs' => 0,
        'fat' => 1,
        'portion' => 100,
    ]);
   }
}
