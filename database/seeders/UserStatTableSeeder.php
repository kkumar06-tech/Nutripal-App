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
            'user_id'=>1 ,
       
        'calories'=>200,
        'weight'=>50,
        'liquid_intake'=>10,
        ]);
    
    }
}
