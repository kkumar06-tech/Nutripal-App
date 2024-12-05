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

    }
}
