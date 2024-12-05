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
            'amount_ml' => 250,
        ]);

        Liquid::create([
            'name' => 'Juice',
            'amount_ml' => 200,
        ]);

        Liquid::create([
            'name' => 'Milk',
            'amount_ml' => 300,
        ]);

    }
}
