<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Liquid;
class LiquidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Liquid::create([
            'name' => 'Water',
        ]);

        Liquid::create([
            'name' => 'Juice',
        ]);

        Liquid::create([
            'name' => 'coffee',
        ]);


        
        
        Liquid::create([
            'name' => 'tea',
        ]);


Liquid::create([
            'name' => 'milk',
        ]);
    
    }

}
