<?php

namespace Database\Seeders;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeIngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Get the recipe (you can also use `first()` or `find()` as needed)
       $recipe = Recipe::where('name', 'Spaghetti Bolognese')->first();

       // Get ingredients
       $tomato = Ingredient::where('name', 'Tomato')->first();
       $beef = Ingredient::where('name', 'Beef')->first();
       $garlic = Ingredient::where('name', 'Garlic')->first();

       $recipe->ingredients()->attach($tomato->id);
       $recipe->ingredients()->attach($beef->id);
       $recipe->ingredients()->attach($garlic->id);
    }
}
