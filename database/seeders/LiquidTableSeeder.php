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
            'calories_per_100ml' => 0,
        ]);
        
        Liquid::create([
            'name' => 'Milk (Whole)',
            'calories_per_100ml' => 65,
        ]);

        Liquid::create([
            'name' => 'Orange Juice',
            'calories_per_100ml' => 45,
        ]);

        Liquid::create([
            'name' => 'Milk (Skimmed)',
            'calories_per_100ml' => 35,
        ]);

    }
}
