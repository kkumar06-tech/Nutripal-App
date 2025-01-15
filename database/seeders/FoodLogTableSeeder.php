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
    
            ] ); 


        FoodLog::create( [ 
         'user_profile_id' => 2,

     ] ); 

    FoodLog::create( [ 
    'user_profile_id' => 3,
                    
      ] ); 


    FoodLog::create( [ 
   'user_profile_id' => 4,
     'date' => '2025-01-14'
    ] );

                    
     FoodLog::create( [
      'user_profile_id' => 4,
     'date' => '2025-01-14'
                    ] );

      FoodLog::create( [ 
        'user_profile_id' => 4,
         'date' => '2025-01-13'
                        ] );

                        FoodLog::create( [ 
                            'user_profile_id' => 4,
             'date' => '2025-01-15'
                            ] );

                            FoodLog::create( [ 
                                'user_profile_id' => 4,
                 'date' => '2025-01-15'
                                ] );
    }
}
