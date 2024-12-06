<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NutritionalValue;
class NutritionalValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NutritionalValue::create( [ 
           'recipe_id'=>1,
            'calories'=>343,
           'carbohydrates'=>334,
            'protein'=>40,
            'fats'=>34
        ] ); 

        NutritionalValue::create( [ 
            'recipe_id'=>2,
             'calories'=>200,
            'carbohydrates'=>333,
             'protein'=>20,
             'fats'=>32
         ] ); 

         NutritionalValue::create( [ 
            'recipe_id'=>3,
             'calories'=>544,
            'carbohydrates'=>330,
             'protein'=>33,
             'fats'=>40
         ] ); 
    }
}
