<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodLog;

class FoodLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodLog::create( [ 
            'user_profile_id' => 1,
            'food_id' => 1,
            'total_calories' => 95,
    
            ] ); 


            FoodLog::create( [ 
                'user_profile_id' => 2,
                'food_id' => 3,
            'total_calories' => null,

                ] ); 

                FoodLog::create( [ 
                    'user_profile_id' => 3,
                    'food_id' => 2,
            'total_calories' => null,
                    
                    ] ); 
    }
}
