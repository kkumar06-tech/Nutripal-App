<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Liquid;
use App\Models\LiquidLog;

class LiquidLiquidLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liquid1 = Liquid::where('name', 'Water')->first();
        $liquid2 = Liquid::where('name', 'Juice')->first();
        $liquid3 = Liquid::where('name', 'water')->first();
        
        // Find liquid log by user_profile_id (this is what ties it to the user)
        $liquidLog1 = LiquidLog::where('user_profile_id', 1)->first();  // Find log for user 1
        $liquidLog2 = LiquidLog::where('user_profile_id', 2)->first();  // Find log for user 2
        $liquidLog3 = LiquidLog::where('user_profile_id', 4)->first();  // Find log for user 2

        $liquidLog4 = LiquidLog::where('user_profile_id', 4)->where('date', '2025-01-13')->first();
        $liquidLog5 = LiquidLog::where('user_profile_id', 4)->where('date', '2025-01-14')->first();
        $liquidLog6 = LiquidLog::where('user_profile_id', 4)->where('date', '2025-01-14')->first();
        $liquidLog7 = LiquidLog::where('user_profile_id', 4)->where('date', '2025-01-15')->first();
        $liquidLog8 = LiquidLog::where('user_profile_id', 4)->where('date', '2025-01-15')->first();



        // Attach liquids to liquid logs (pivot table insertion)
        if ($liquid1 && $liquidLog1) {
            $liquid1->liquidlogs()->attach($liquidLog1->id);
        }

        if ($liquid2 && $liquidLog2) {
            $liquid2->liquidlogs()->attach($liquidLog2->id);
        }

        if ($liquid3 && $liquidLog3) {
            $liquid3->liquidlogs()->attach($liquidLog3->id);
        }

        if ($liquid3 && $liquidLog4) {
            $liquid3->liquidlogs()->attach($liquidLog4->id);
        }   
        
        if ($liquid1 && $liquidLog5) {
            $liquid1->liquidlogs()->attach($liquidLog5->id);
        }
        
        if ($liquid2 && $liquidLog6) {
            $liquid2->liquidlogs()->attach($liquidLog6->id);
        } 
        
        if ($liquid2 && $liquidLog7) {
            $liquid2->liquidlogs()->attach($liquidLog7->id);
        }
        
        if ($liquid3 && $liquidLog8) {
            $liquid3->liquidlogs()->attach($liquidLog8->id);
        }

    }
}
