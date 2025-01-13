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
       
        'calories'=>200,
        'protein'=>50,
        'fat'=>80,
        'carbs'=>120,
        'liquid_intake'=>10,
        ]);
    
    }
}
