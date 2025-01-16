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
            'user_id' => 1, 
            'credentials' => 'Certified Nutritionist with 5+ years of experience.',
            'certificate_image' => 'images/certificates/certificate1.jpg',
            'profile_image' => 'images/profiles/profile1.jpg',
            'bio_description' => 'Experienced nutritionist specializing in diet planning and fitness.',
        ]);

        NutritionistProfile::create([
            'user_id' => 2, 
            'credentials' => 'Certified Nutritionist with 5+ years of experience.',
            'certificate_image' => 'images/certificates/certificate1.jpg',
            'profile_image' => 'images/profiles/profile1.jpg',
            'bio_description' => 'Experienced nutritionist specializing in diet planning and fitness.',
        ]);
        
        NutritionistProfile::create([
            'user_id' => 3,  // Added another nutritionist with user_id 3
            'credentials' => 'Certified Nutritionist with 10+ years of experience.',
            'certificate_image' => 'images/certificates/certificate2.jpg',
            'profile_image' => 'images/profiles/profile2.jpg',
            'bio_description' => 'Expert in managing weight loss and healthy eating habits.',
        ]);
    }
}
