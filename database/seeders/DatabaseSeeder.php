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
            $this->call(RecipeTableSeeder::class);
            $this->call(FoodLogTableSeeder::class);
            $this->call(UserStatTableSeeder::class);


           
        }
    
}
