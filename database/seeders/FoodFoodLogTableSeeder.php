<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodLog;
use App\Models\Food;

class FoodFoodLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food1 = Food::where('name', 'Apple')->first();
        $food2 = Food::where('name', 'Chicken Breast')->first();
        $food3 = Food::where('name', 'Banana')->first();
        
        // Find food log by user_profile_id (this is what ties it to the user)
        $foodLog1 =FoodLog::where('user_profile_id', 1)->first();  // Find log for user 1
        $foodLog2 = FoodLog::where('user_profile_id', 2)->first();  // Find log for user 2
        $foodLog3 = FoodLog::where('user_profile_id', 3)->first();  // Find log for user 2

        // Attach foodss to food logs (pivot table insertion)
        if ($food1 && $foodLog1) {
            $food1->foodlogs()->attach($foodLog1->id);
        }

        if ($food2 && $foodLog2) {
            $food2->foodlogs()->attach($foodLog2->id);
        }
        
        if ($food3 && $foodLog3) {
            $food3->foodlogs()->attach($foodLog3->id);
        }
    }
}
