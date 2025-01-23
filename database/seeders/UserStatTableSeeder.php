<?php

namespace Database\Seeders;
use App\Models\UserStat;
use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        UserStat::create([
            'user_id'=>4 ,
       
        'calories'=>0,
        'protein'=>0,
        'fat'=>0,
        'carbs'=>0,
        'liquid_intake'=>0,
        ]);


        UserStat::create([
            'user_id' => 4,
            'date' => Carbon::now()->subDays(1)->format('Y-m-d'), // Yesterday
            'calories' => 165,
            'protein' => 31,
            'fat' => 30,
            'carbs' => 3,
            'liquid_intake' => 2000,
        ]);

        UserStat::create([
            'user_id' => 4,
            'date' => Carbon::now()->subDays(2)->format('Y-m-d'), // 2 days ago
            'calories' => 23,
            'protein' => 3,
            'fat' => 40,
            'carbs' => 2,
            'liquid_intake' => 1800,
        ]);

        UserStat::create([
            'user_id' => 4,
            'date' => Carbon::now()->subDays(3)->format('Y-m-d'), // 3 days ago
            'calories' => 322,
            'protein' => 33,
            'fat' => 23,
            'carbs' => 432,
            'liquid_intake' => 456,
        ]);

        UserStat::create([
            'user_id'=>2 ,
            'calories'=>0,
            'protein'=>0,
            'fat'=>0,
            'carbs'=>0,
            'liquid_intake'=>0,
        ]);
    
    }
}
