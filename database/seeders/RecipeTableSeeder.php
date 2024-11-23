<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipe::create([
            'name' => 'Spaghetti Bolognese',
            'description' => 'A classic Italian pasta dish made with a rich tomato and meat sauce.',
            'image' => 'spaghetti_bolognese.jpg', // Add image path or URL as needed
            'cooking_time' => 30, // Time in minutes
            'difficulty' => 'medium',
            'cuisine_type' => 'Italian',
            'meal_type' => 'Dinner',
        ]);

        Recipe::create([
            'name' => 'Chicken Caesar Salad',
            'description' => 'A fresh and healthy salad with grilled chicken, romaine lettuce, and Caesar dressing.',
            'image' => 'chicken_caesar_salad.jpg', 
            'cooking_time' => 15,
            'difficulty' => 'easy',
            'cuisine_type' => 'American',
            'meal_type' => 'Lunch',
        ]);

        Recipe::create([
            'name' => 'Vegetable Stir Fry',
            'description' => 'A quick and easy stir fry with a mix of colorful vegetables and soy sauce.',
            'image' => 'vegetable_stir_fry.jpg', 
            'cooking_time' => 20, 
            'difficulty' => 'easy',
            'cuisine_type' => 'Asian',
            'meal_type' => 'Dinner',
        ]);
    }
}
