<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(){
            $this->call(UserTableSeeder::class);
            $this->call(UserProfileTableSeeder::class);
            $this->call(FoodTableSeeder::class);
            $this->call(FoodLogTableSeeder::class);
            $this->call(UserStatTableSeeder::class);
            $this->call(MealPlanTableSeeder::class);
            $this->call(NutritionistProfileTableSeeder::class);
            $this->call(AppointmentTableSeeder::class);
            $this->call(ConversationTableSeeder::class);
            $this->call(MessageTableSeeder::class);
            $this->call(NotificationSeeder::class);


            $this->call(FoodFoodLogTableSeeder::class);


       

            $this->call([
                LiquidTableSeeder::class,  // Seed ingredients
                LiquidLogTableSeeder::class,  // Seed recipes
                LiquidLiquidLogTableSeeder::class,  // Seed the pivot table
            ]);
           
        }
    
}
