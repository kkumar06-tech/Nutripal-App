<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LiquidLog;
class LiquidLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        LiquidLog::create([ 
          'user_profile_id' => 1,
        
          'total_amount_ml' => 4000,
          'date' => now()->format('Y-m-d')  
      ]); 
        
      LiquidLog::create([ 
        'user_profile_id' => 2,
        
        'total_amount_ml' => 1600,
        'date' => now()->format('Y-m-d')  
    ]);

    LiquidLog::create([ 
        'user_profile_id' => 4,
        
        'total_amount_ml' => 2000,
   'date' => '2025-01-13'
    ]);

    LiquidLog::create([ 
        'user_profile_id' => 4,
        
        'total_amount_ml' => 2000,
   'date' => '2025-01-14'
    ]);   
    
    LiquidLog::create([ 
        'user_profile_id' => 4,
        
        'total_amount_ml' => 1300,
        'date' => '2025-01-14'
    ]);
    
    LiquidLog::create([ 
        'user_profile_id' => 4,
        
        'total_amount_ml' => 1100,
       'date' => '2025-01-15'
    ]);

    LiquidLog::create([ 
        'user_profile_id' => 4,
        
        'total_amount_ml' => 1200,
       'date' => '2025-01-15'
    ]);


    }
}
