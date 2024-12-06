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
        
        // Find liquid log by user_profile_id (this is what ties it to the user)
        $liquidLog1 = LiquidLog::where('user_profile_id', 1)->first();  // Find log for user 1
        $liquidLog2 = LiquidLog::where('user_profile_id', 2)->first();  // Find log for user 2

        // Attach liquids to liquid logs (pivot table insertion)
        if ($liquid1 && $liquidLog1) {
            $liquid1->liquidlogs()->attach($liquidLog1->id);
        }

        if ($liquid2 && $liquidLog2) {
            $liquid2->liquidlogs()->attach($liquidLog2->id);
        }
    }
}
