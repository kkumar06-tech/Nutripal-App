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
        'portion' => 100,
        'food_image'=>'food_images/apple.png'
    ]);
    
    Food::create([
        'name' => 'Banana',
        'meal_type' => 'Breakfast',
        'calories' => 105,
        'protein' => 1,
        'carbs' => 27,
        'fat' => 0,
        'portion' => 100,
         'food_image'=>'food_images/banana.png'
    ]);
    
    Food::create([
        'name' => 'Chicken Breast',
        'meal_type' => 'Lunch',
        'calories' => 165,
        'protein' => 31,
        'carbs' => 0,
        'fat' => 3,
        'portion' => 100,
         'food_image'=>'food_images/chicken.png'
    ]);
    
    Food::create([
        'name' => 'Mushroom Curry',
        'meal_type' => 'Dinner',
        'calories' => 106,
        'protein' => 10,
        'carbs' => 50,
        'fat' => 20,
        'portion' => 100,
         'food_image'=>'food_images/stew.png'
    ]);
    
    Food::create([
        'name' => 'Almonds',
        'meal_type' => 'Snack',
        'calories' => 576,
        'protein' => 21,
        'carbs' => 22,
        'fat' => 49,
        'portion' => 100,
         'food_image'=>'food_images/almonds.png'
    ]);
    
    Food::create([
        'name' => 'Salmon',
        'meal_type' => 'Lunch',
        'calories' => 208,
        'protein' => 20,
        'carbs' => 0,
        'fat' => 13,
        'portion' => 100,
         'food_image'=>'food_images/salmon.png'
    ]);
    
    Food::create([
        'name' => 'Greek Yogurt',
        'meal_type' => 'Breakfast',
        'calories' => 59,
        'protein' => 10,
        'carbs' => 3,
        'fat' => 0,
        'portion' => 100,
         'food_image'=>'food_images/yogurt.png'
    ]);
    

    
    Food::create([
        'name' => 'Broccoli',
        'meal_type' => 'Dinner',
        'calories' => 55,
        'protein' => 4,
        'carbs' => 11,
        'fat' => 0,
        'portion' => 100,
         'food_image'=>'food_images/broccoli.png'
    ]);
    
    Food::create([
        'name' => 'Eggs',
        'meal_type' => 'Breakfast',
        'calories' => 155,
        'protein' => 13,
        'carbs' => 1,
        'fat' => 11,
        'portion' => 100,
        'food_image'=>'food_images/eggs.png'
    ]);
    
    Food::create([
        'name' => 'Rice',
        'meal_type' => 'Lunch',
        'calories' => 130,
        'protein' => 2,
        'carbs' => 28,
        'fat' => 0,
        'portion' => 100,
        'food_image'=>'food_images/rice.png'
    ]);
    
    Food::create([
        'name' => 'Tofu',
        'meal_type' => 'Lunch',
        'calories' => 144,
        'protein' => 16,
        'carbs' => 3,
        'fat' => 8,
        'portion' => 100,
        'food_image'=>'food_images/tofu.png'
    ]);
    
 
    
    Food::create([
        'name' => 'Sweet Potato',
        'meal_type' => 'Lunch',
        'calories' => 86,
        'protein' => 2,
        'carbs' => 20,
        'fat' => 0,
        'portion' => 100,
        'food_image'=>'food_images/sweetpotato.png'
    ]);
    
    Food::create([
        'name' => 'Lentil Soup',
        'meal_type' => 'Dinner',
        'calories' => 116,
        'protein' => 9,
        'carbs' => 20,
        'fat' => 2,
        'portion' => 100,
    'food_image'=>'food_images/stew3.png'
    ]);
    
    Food::create([
        'name' => 'Cheddar Cheese',
        'meal_type' => 'Snack',
        'calories' => 403,
        'protein' => 25,
        'carbs' => 1,
        'fat' => 33,
        'portion' => 100,
        'food_image'=>'food_images/cheese.png'
    ]);
    
    Food::create([
        'name' => 'Orange',
        'meal_type' => 'Breakfast',
        'calories' => 62,
        'protein' => 1,
        'carbs' => 15,
        'fat' => 0,
        'portion' => 100,
        'food_image'=>'food_images/orange.png'
    ]);
    
    Food::create([
        'name' => 'Spinach',
        'meal_type' => 'Dinner',
        'calories' => 23,
        'protein' => 3,
        'carbs' => 4,
        'fat' => 0,
        'portion' => 100,
        'food_image'=>'food_images/spinach.png'
    ]);
    
    Food::create([
        'name' => 'Avocado',
        'meal_type' => 'Lunch',
        'calories' => 160,
        'protein' => 2,
        'carbs' => 9,
        'fat' => 15,
        'portion' => 100,
        'food_image'=>'food_images/avocado.png'
    ]);
    
    Food::create([
        'name' => 'Beef Steak',
        'meal_type' => 'Dinner',
        'calories' => 271,
        'protein' => 25,
        'carbs' => 0,
        'fat' => 19,
        'portion' => 100,
        'food_image'=>'food_images/meat.png'
    ]);
    

    
    Food::create([
        'name' => 'Pasta',
        'meal_type' => 'Lunch',
        'calories' => 131,
        'protein' => 5,
        'carbs' => 25,
        'fat' => 1,
        'portion' => 100,
        'food_image'=>'food_images/pasta.png'
    ]);
    
    Food::create([
        'name' => 'Blueberries',
        'meal_type' => 'Breakfast',
        'calories' => 57,
        'protein' => 1,
        'carbs' => 14,
        'fat' => 0,
        'portion' => 100,
        'food_image'=>'food_images/blueberry.png'
    ]);
    
    Food::create([
        'name' => 'Dark Chocolate',
        'meal_type' => 'Snack',
        'calories' => 546,
        'protein' => 5,
        'carbs' => 46,
        'fat' => 31,
        'portion' => 100,
        'food_image'=>'food_images/chocolate.png'
    ]);
    
    Food::create([
        'name' => 'Turkey Breast',
        'meal_type' => 'Lunch',
        'calories' => 135,
        'protein' => 30,
        'carbs' => 0,
        'fat' => 1,
        'portion' => 100,
    'food_image'=>'food_images/chicken2.png'
    ]);
  


   Food::create([
    'name' => 'Rye Bread',
    'meal_type' => 'Snack',
    'calories' => 259,
    'protein' => 8,
    'carbs' => 48,
    'fat' => 3.3,
    'portion' => 100,
    'food_image'=>'food_images/bread.png'
]);

Food::create([
    'name' => 'Mediterranean Salad',
    'meal_type' => 'Lunch',
    'calories' => 150,
    'protein' => 3,
    'carbs' => 10,
    'fat' => 12,
    'portion' => 150,
    'food_image'=>'food_images/salad.png'
]);



Food::create([
    'name' => 'Quinoa Salad',
    'meal_type' => 'Dinner',
    'calories' => 120,
    'protein' => 5,
    'carbs' => 21,
    'fat' => 3,
    'portion' => 100,
    'food_image'=>'food_images/ricesalad.png'
]);

Food::create([
    'name' => 'Italian Minestrone Soup',
    'meal_type' => 'Dinner',
    'calories' => 80,
    'protein' => 3,
    'carbs' => 14,
    'fat' => 2,
    'portion' => 200,
    'food_image'=>'food_images/stew2.png',
'food_image'=>'food_images/stew4.png'
]);

Food::create([
    'name' => 'French Ratatouille',
    'meal_type' => 'Dinner',
    'calories' => 90,
    'protein' => 7,
    'carbs' => 7,
    'fat' => 6,
    'portion' => 200,
    'food_image'=>'food_images/.png',
    'food_image'=>'food_images/ratatoie.png'
]);

Food::create([
    'name' => 'Smoked Salmon',
    'meal_type' => 'Snack',
    'calories' => 117,
    'protein' => 20,
    'carbs' => 0,
    'fat' => 4,
    'portion' => 85,
    'food_image'=>'food_images/salmon.png'
]);

Food::create([
    'name' => 'Swedish Knäckebröd',
    'meal_type' => 'Snack',
    'calories' => 350,
    'protein' => 9,
    'carbs' => 68,
    'fat' => 2,
    'portion' => 100,
    'food_image'=>'food_images/cracker.png'
]);

   }

}
