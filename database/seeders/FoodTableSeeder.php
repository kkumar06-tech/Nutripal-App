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
        'meal_type' => 'Breakfast',
        'calories' => 95,
        'protein' => 0,
        'carbs' => 25,
        'fat' => 0,
        'portion' => json_encode([100, 150]), 
        'food_image' => 'food_images/apple.png',
        'cuisine_type' => 'Other',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Banana',
        'meal_type' => 'Breakfast',
        'calories' => 105,
        'protein' => 1,
        'carbs' => 27,
        'fat' => 0,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/banana.png',
        'cuisine_type' => 'Other',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Chicken Breast',
        'meal_type' => 'Lunch',
        'calories' => 165,
        'protein' => 31,
        'carbs' => 0,
        'fat' => 3,
        'portion' => json_encode([100, 200]),
        'food_image' => 'food_images/chicken.png',
        'cuisine_type' => 'European',
        'cooking_time' => 20,
        'dietary_preferences' => json_encode(['Halal', 'Pescetarian']),
    ]);
    
    Food::create([
        'name' => 'Mushroom Curry',
        'meal_type' => 'Dinner',
        'calories' => 106,
        'protein' => 10,
        'carbs' => 50,
        'fat' => 20,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/stew.png',
        'cuisine_type' => 'Indian',
        'cooking_time' => 45,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Almonds',
        'meal_type' => 'Snack',
        'calories' => 576,
        'protein' => 21,
        'carbs' => 22,
        'fat' => 49,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/almonds.png',
        'cuisine_type' => 'Other',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Salmon',
        'meal_type' => 'Lunch',
        'calories' => 208,
        'protein' => 20,
        'carbs' => 0,
        'fat' => 13,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/salmon.png',
        'cuisine_type' => 'European',
        'cooking_time' => 20,
        'dietary_preferences' => json_encode(['Pescetarian']),
    ]);
    
    Food::create([
        'name' => 'Greek Yogurt',
        'meal_type' => 'Breakfast',
        'calories' => 59,
        'protein' => 10,
        'carbs' => 3,
        'fat' => 0,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/yogurt.png',
        'cuisine_type' => 'European',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Halal']),
    ]);
    
    Food::create([
        'name' => 'Broccoli',
        'meal_type' => 'Dinner',
        'calories' => 55,
        'protein' => 4,
        'carbs' => 11,
        'fat' => 0,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/broccoli.png',
        'cuisine_type' => 'European',
        'cooking_time' => 10,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Eggs',
        'meal_type' => 'Breakfast',
        'calories' => 155,
        'protein' => 13,
        'carbs' => 1,
        'fat' => 11,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/eggs.png',
        'cuisine_type' => 'European',
        'cooking_time' => 10,
        'dietary_preferences' => json_encode(['Halal']),
    ]);
    
    Food::create([
        'name' => 'Rice',
        'meal_type' => 'Lunch',
        'calories' => 130,
        'protein' => 2,
        'carbs' => 28,
        'fat' => 0,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/rice.png',
        'cuisine_type' => 'Asian',
        'cooking_time' => 15,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Tofu',
        'meal_type' => 'Lunch',
        'calories' => 144,
        'protein' => 16,
        'carbs' => 3,
        'fat' => 8,
        'portion' => json_encode([100, 150]),
        'food_image' => 'food_images/tofu.png',
        'cuisine_type' => 'Asian',
        'cooking_time' => 15,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Sweet Potato',
        'meal_type' => 'Lunch',
        'calories' => 86,
        'protein' => 2,
        'carbs' => 20,
        'fat' => 0,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/sweetpotato.png',
        'cuisine_type' => 'Other',
        'cooking_time' => 30,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Lentil Soup',
        'meal_type' => 'Dinner',
        'calories' => 116,
        'protein' => 9,
        'carbs' => 20,
        'fat' => 2,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/stew3.png',
        'cuisine_type' => 'Middle Eastern',
        'cooking_time' => 40,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Cheddar Cheese',
        'meal_type' => 'Snack',
        'calories' => 403,
        'protein' => 25,
        'carbs' => 1,
        'fat' => 33,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/cheese.png',
        'cuisine_type' => 'European',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Gluten Free']),
    ]);

    Food::create([
        'name' => 'Orange',
        'meal_type' => 'Breakfast',
        'calories' => 62,
        'protein' => 1,
        'carbs' => 15,
        'fat' => 0,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/orange.png',
        'cuisine_type' => 'Other',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Spinach',
        'meal_type' => 'Dinner',
        'calories' => 23,
        'protein' => 3,
        'carbs' => 4,
        'fat' => 0,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/spinach.png',
        'cuisine_type' => 'European',
        'cooking_time' => 10,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Avocado',
        'meal_type' => 'Lunch',
        'calories' => 160,
        'protein' => 2,
        'carbs' => 9,
        'fat' => 15,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/avocado.png',
        'cuisine_type' => 'Mexican',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Beef Steak',
        'meal_type' => 'Dinner',
        'calories' => 271,
        'protein' => 25,
        'carbs' => 0,
        'fat' => 19,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/meat.png',
        'cuisine_type' => 'European',
        'cooking_time' => 20,
        'dietary_preferences' => json_encode(['Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Pasta',
        'meal_type' => 'Lunch',
        'calories' => 131,
        'protein' => 5,
        'carbs' => 25,
        'fat' => 1,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/pasta.png',
        'cuisine_type' => 'Italian',
        'cooking_time' => 15,
        'dietary_preferences' => json_encode(['Vegetarian', 'Gluten Free (if gluten-free pasta)']),
    ]);
    
    Food::create([
        'name' => 'Blueberries',
        'meal_type' => 'Breakfast',
        'calories' => 57,
        'protein' => 1,
        'carbs' => 14,
        'fat' => 0,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/blueberry.png',
        'cuisine_type' => 'Other',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Dark Chocolate',
        'meal_type' => 'Snack',
        'calories' => 546,
        'protein' => 5,
        'carbs' => 46,
        'fat' => 31,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/chocolate.png',
        'cuisine_type' => 'European',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegetarian', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Turkey Breast',
        'meal_type' => 'Lunch',
        'calories' => 135,
        'protein' => 30,
        'carbs' => 0,
        'fat' => 1,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/chicken2.png',
        'cuisine_type' => 'European',
        'cooking_time' => 15,
        'dietary_preferences' => json_encode(['Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Rye Bread',
        'meal_type' => 'Snack',
        'calories' => 259,
        'protein' => 8,
        'carbs' => 48,
        'fat' => 3.3,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/bread.png',
        'cuisine_type' => 'European',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegetarian']),
    ]);
  
    Food::create([
        'name' => 'Mediterranean Salad',
        'meal_type' => 'Lunch',
        'calories' => 150,
        'protein' => 3,
        'carbs' => 10,
        'fat' => 12,
        'portion' => json_encode([150]),
        'food_image' => 'food_images/salad.png',
        'cuisine_type' => 'European',
        'cooking_time' => 10,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Quinoa Salad',
        'meal_type' => 'Dinner',
        'calories' => 120,
        'protein' => 5,
        'carbs' => 21,
        'fat' => 3,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/ricesalad.png',
        'cuisine_type' => 'European',
        'cooking_time' => 15,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Italian Minestrone Soup',
        'meal_type' => 'Dinner',
        'calories' => 80,
        'protein' => 3,
        'carbs' => 14,
        'fat' => 2,
        'portion' => json_encode([200]),
        'food_image' => 'food_images/stew4.png',
        'cuisine_type' => 'Italian',
        'cooking_time' => 30,
        'dietary_preferences' => json_encode(['Vegan', 'Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'French Ratatouille',
        'meal_type' => 'Dinner',
        'calories' => 90,
        'protein' => 7,
        'carbs' => 7,
        'fat' => 6,
        'portion' => json_encode([200]),
        'food_image' => 'food_images/ratatouille.png',
        'cuisine_type' => 'European',
        'cooking_time' => 30,
        'dietary_preferences' => json_encode(['Vegan']),
    ]);
    
    Food::create([
        'name' => 'Smoked Salmon',
        'meal_type' => 'Snack',
        'calories' => 117,
        'protein' => 20,
        'carbs' => 0,
        'fat' => 4,
        'portion' => json_encode([85]),
        'food_image' => 'food_images/salmon.png',
        'cuisine_type' => 'European',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Gluten Free']),
    ]);
    
    Food::create([
        'name' => 'Swedish Knäckebröd',
        'meal_type' => 'Snack',
        'calories' => 350,
        'protein' => 9,
        'carbs' => 68,
        'fat' => 2,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/cracker.png',
        'cuisine_type' => 'European',
        'cooking_time' => 0,
        'dietary_preferences' => json_encode(['Vegetarian']),
    ]);
    
    Food::create([
        'name' => 'Kung Pao Chicken',
        'meal_type' => 'Dinner',
        'calories' => 280,
        'protein' => 24,
        'carbs' => 10,
        'fat' => 17,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/kung_pao_chicken.png',
        'cuisine_type' => 'Chinese',
        'cooking_time' => 20,
        'dietary_preferences' => json_encode(['Non-Vegetarian']),
    ]);
    
    Food::create([
        'name' => 'Bibimbap',
        'meal_type' => 'Lunch',
        'calories' => 500,
        'protein' => 22,
        'carbs' => 70,
        'fat' => 14,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/bibimbap.png',
        'cuisine_type' => 'Korean',
        'cooking_time' => 25,
        'dietary_preferences' => json_encode(['Vegetarian']),
    ]);
    
    Food::create([
        'name' => 'Jollof Rice',
        'meal_type' => 'Lunch',
        'calories' => 350,
        'protein' => 7,
        'carbs' => 65,
        'fat' => 9,
        'portion' => json_encode([100]),
        'food_image' => 'food_images/jollof_rice.png',
        'cuisine_type' => 'African',
        'cooking_time' => 45,
        'dietary_preferences' => json_encode(['Vegetarian']),
    ]);

    
   }

}