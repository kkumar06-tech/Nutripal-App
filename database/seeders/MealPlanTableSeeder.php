<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealPlan;
class MealPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MealPlan::create([
            'user_id' => 1,
            'date' => '2024-12-04', 
        ]);

        MealPlan::create([
            'user_id' => 2,
            'date' => '2024-12-05', 
        ]);
    }
}
