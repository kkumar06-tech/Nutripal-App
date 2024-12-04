<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NutritionistProfile;
class NutritionistProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NutritionistProfile::create([
            'user_id' => 4, 
            'credentials' => 'Certified Nutritionist with 5+ years of experience.',
            'certificate_image' => 'images/certificates/certificate1.jpg',
            'profile_image' => 'images/profiles/profile1.jpg',
            'bio_description' => 'Experienced nutritionist specializing in diet planning and fitness.',
        ]);

        NutritionistProfile::create([
            'user_id' => 5, 
            'credentials' => 'Certified Nutritionist with 5+ years of experience.',
            'certificate_image' => 'images/certificates/certificate1.jpg',
            'profile_image' => 'images/profiles/profile1.jpg',
            'bio_description' => 'Experienced nutritionist specializing in diet planning and fitness.',
        ]);
    }
}
