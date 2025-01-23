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
            'user_id' => 5, 
            'name'=>'Ondrej Gaus',
            'credentials' => 'Certified Nutritionist with 5+ years of experience.',
            'certificate_image' => 'images/certificates/certificate1.jpg',
            'profile_image' => 'expert_images/expert3.jpg',
            'bio_description' => 'Experienced nutritionist specializing in diet planning and fitness.',
            'rating' => 4.5, 
            'total_ratings' => 100, 
        ]);

        NutritionistProfile::create([
            'user_id' => 6,
            'name'=>'Aastha Virdi', 
            'credentials' => 'Certified Nutritionist with 5+ years of experience.',
            'certificate_image' => 'images/certificates/certificate1.jpg',
            'profile_image' => 'expert_images/expert2.jpg',
            'bio_description' => 'Experienced nutritionist specializing in diet planning and fitness.',
            'rating' => 4.3, 
            'total_ratings' => 85,
        ]);
        
        NutritionistProfile::create([
            'user_id' => 7,  
            'name'=>'Nana',
            'credentials' => 'Certified Nutritionist with 10+ years of experience.',
            'certificate_image' => 'images/certificates/certificate2.jpg',
            'profile_image' => 'expert_images/expert1.jpg',
            'bio_description' => 'Expert in managing weight loss and healthy eating habits.',
            'rating' => 4.8, 
            'total_ratings' => 200,
        ]);
    }
}
