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
        'image' => 'spaghetti_bolognese.jpg',
        'cooking_time' => 30,
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
    
    Recipe::create([
        'name' => 'Beef Tacos',
        'description' => 'Delicious Mexican tacos filled with seasoned beef, fresh vegetables, and salsa.',
        'image' => 'beef_tacos.jpg',
        'cooking_time' => 25,
        'difficulty' => 'easy',
        'cuisine_type' => 'Mexican',
        'meal_type' => 'Lunch',
    ]);
    
    Recipe::create([
        'name' => 'Butter Chicken',
        'description' => 'A rich and creamy Indian curry made with tender chicken pieces.',
        'image' => 'butter_chicken.jpg',
        'cooking_time' => 40,
        'difficulty' => 'medium',
        'cuisine_type' => 'Indian',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Greek Salad',
        'description' => 'A refreshing salad with tomatoes, cucumbers, olives, feta cheese, and olive oil.',
        'image' => 'greek_salad.jpg',
        'cooking_time' => 10,
        'difficulty' => 'easy',
        'cuisine_type' => 'Greek',
        'meal_type' => 'Lunch',
    ]);
    
    Recipe::create([
        'name' => 'Sushi Rolls',
        'description' => 'Japanese sushi rolls filled with rice, seafood, and vegetables.',
        'image' => 'sushi_rolls.jpg',
        'cooking_time' => 50,
        'difficulty' => 'hard',
        'cuisine_type' => 'Japanese',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'French Onion Soup',
        'description' => 'A classic French soup with caramelized onions and a cheesy crouton topping.',
        'image' => 'french_onion_soup.jpg',
        'cooking_time' => 45,
        'difficulty' => 'medium',
        'cuisine_type' => 'French',
        'meal_type' => 'Snack',
    ]);
    
    Recipe::create([
        'name' => 'Avocado Toast',
        'description' => 'A simple and healthy breakfast with mashed avocado on toasted bread.',
        'image' => 'avocado_toast.jpg',
        'cooking_time' => 5,
        'difficulty' => 'easy',
        'cuisine_type' => 'American',
        'meal_type' => 'Breakfast',
    ]);
    
    Recipe::create([
        'name' => 'Pancakes',
        'description' => 'Fluffy and golden pancakes served with syrup and butter.',
        'image' => 'pancakes.jpg',
        'cooking_time' => 15,
        'difficulty' => 'easy',
        'cuisine_type' => 'American',
        'meal_type' => 'Breakfast',
    ]);
    
    Recipe::create([
        'name' => 'Lasagna',
        'description' => 'A hearty Italian dish with layers of pasta, meat, cheese, and tomato sauce.',
        'image' => 'lasagna.jpg',
        'cooking_time' => 60,
        'difficulty' => 'hard',
        'cuisine_type' => 'Italian',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Pad Thai',
        'description' => 'A popular Thai stir-fried noodle dish with shrimp, tofu, and peanuts.',
        'image' => 'pad_thai.jpg',
        'cooking_time' => 30,
        'difficulty' => 'medium',
        'cuisine_type' => 'Thai',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Grilled Cheese Sandwich',
        'description' => 'A simple and delicious sandwich with melted cheese and crispy bread.',
        'image' => 'grilled_cheese.jpg',
        'cooking_time' => 10,
        'difficulty' => 'easy',
        'cuisine_type' => 'American',
        'meal_type' => 'Snack',
    ]);
    
    Recipe::create([
        'name' => 'Ratatouille',
        'description' => 'A traditional French vegetable dish made with zucchini, eggplant, and tomatoes.',
        'image' => 'ratatouille.jpg',
        'cooking_time' => 35,
        'difficulty' => 'medium',
        'cuisine_type' => 'French',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Pho',
        'description' => 'A flavorful Vietnamese noodle soup with beef or chicken.',
        'image' => 'pho.jpg',
        'cooking_time' => 60,
        'difficulty' => 'hard',
        'cuisine_type' => 'Vietnamese',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Shakshuka',
        'description' => 'A Middle Eastern dish of poached eggs in a spicy tomato sauce.',
        'image' => 'shakshuka.jpg',
        'cooking_time' => 25,
        'difficulty' => 'easy',
        'cuisine_type' => 'Middle Eastern',
        'meal_type' => 'Breakfast',
    ]);
    
    Recipe::create([
        'name' => 'Shepherd’s Pie',
        'description' => 'A comforting British dish with ground meat and mashed potato topping.',
        'image' => 'shepherds_pie.jpg',
        'cooking_time' => 50,
        'difficulty' => 'medium',
        'cuisine_type' => 'British',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Fish and Chips',
        'description' => 'Crispy battered fish served with fries and tartar sauce.',
        'image' => 'fish_and_chips.jpg',
        'cooking_time' => 30,
        'difficulty' => 'medium',
        'cuisine_type' => 'British',
        'meal_type' => 'Lunch',
    ]);
    
    Recipe::create([
        'name' => 'Beef Bourguignon',
        'description' => 'A French stew made with beef braised in red wine and vegetables.',
        'image' => 'beef_bourguignon.jpg',
        'cooking_time' => 120,
        'difficulty' => 'hard',
        'cuisine_type' => 'French',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Churros',
        'description' => 'Mexican fried dough pastries coated in cinnamon sugar.',
        'image' => 'churros.jpg',
        'cooking_time' => 20,
        'difficulty' => 'medium',
        'cuisine_type' => 'Mexican',
        'meal_type' => 'Snack',
    ]);
    
    Recipe::create([
        'name' => 'Fried Rice',
        'description' => 'A quick and versatile dish made with rice, vegetables, and your choice of protein.',
        'image' => 'fried_rice.jpg',
        'cooking_time' => 20,
        'difficulty' => 'easy',
        'cuisine_type' => 'Asian',
        'meal_type' => 'Lunch',
    ]);
    
    Recipe::create([
        'name' => 'Tom Yum Soup',
        'description' => 'A hot and sour Thai soup with shrimp and fragrant herbs.',
        'image' => 'tom_yum.jpg',
        'cooking_time' => 30,
        'difficulty' => 'medium',
        'cuisine_type' => 'Thai',
        'meal_type' => 'Dinner',
    ]);
    
    Recipe::create([
        'name' => 'Tiramisu',
        'description' => 'An Italian dessert made with coffee-soaked ladyfingers and mascarpone cheese.',
        'image' => 'tiramisu.jpg',
        'cooking_time' => 25,
        'difficulty' => 'medium',
        'cuisine_type' => 'Italian',
        'meal_type' => 'Snack',
    ]);
    
    Recipe::create([
        'name' => 'Hummus and Pita',
        'description' => 'A Middle Eastern appetizer with creamy hummus and warm pita bread.',
        'image' => 'hummus_and_pita.jpg',
        'cooking_time' => 10,
        'difficulty' => 'easy',
        'cuisine_type' => 'Middle Eastern',
        'meal_type' => 'Snack',
    ]);
    
    Recipe::create([
        'name' => 'Banana Bread',
        'description' => 'A moist and sweet bread made with ripe bananas.',
        'image' => 'banana_bread.jpg',
        'cooking_time' => 60,
        'difficulty' => 'medium',
        'cuisine_type' => 'American',
        'meal_type' => 'Snack',
    ]);
}
}
