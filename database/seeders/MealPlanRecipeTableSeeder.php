<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\MealPlan;

class MealPlanRecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipe1 =  Recipe::where('name', 'Chicken Caesar Salad')->first();
        $recipe2 = Recipe::where('name', 'Vegetable Stir Fry')->first();
        
        // Find liquid log by user_profile_id (this is what ties it to the user)
        $mealPlan1 = MealPlan::where('user_id', 1)->first();  // Find log for user 1
        $mealPlan2 = MealPlan::where('user_id', 2)->first();  // Find log for user 2

         // Attach liquids to liquid logs (pivot table insertion)
         if ($recipe1 && $mealPlan1) {
            $recipe1->mealPlans()->attach($mealPlan1->id);
        }

        if ($recipe2 && $mealPlan2) {
            $recipe2->mealPlans()->attach($mealPlan2->id);
        }
    }
    }

