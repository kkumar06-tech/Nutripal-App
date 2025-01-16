<?php

namespace Database\Seeders;
use App\Models\UserStat;

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
    
    }
}
