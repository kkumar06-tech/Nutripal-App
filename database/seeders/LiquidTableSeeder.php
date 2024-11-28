<?php

namespace Database\Seeders;

use App\Models\Water;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Water::create([
            'name' => 'Water',
            'calories' => 0,
        ]);
        
        Water::create([
            'name' => 'Milk (Whole)',
            'calories' => 65,
        ]);

        Water::create([
            'name' => 'Orange Juice',
            'calories' => 45,
        ]);

        Water::create([
            'name' => 'Milk (Skimmed)',
            'calories' => 35,
        ]);

    }
}
