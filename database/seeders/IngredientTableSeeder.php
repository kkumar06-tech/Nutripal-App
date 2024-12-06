<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingredient::create(['name' => 'Tomato']);
        Ingredient::create(['name' => 'Beef']);
        Ingredient::create(['name' => 'Garlic']);
        Ingredient::create(['name' => 'Flour']);
        Ingredient::create(['name' => 'Sugar']);
        Ingredient::create(['name' => 'Butter']);
        Ingredient::create(['name' => 'Eggs']);
        Ingredient::create(['name' => 'Salt']);
    }
}
