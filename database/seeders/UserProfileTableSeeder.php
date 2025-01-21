<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfile::create([
            'user_id' => 1, 
            'name' => 'Tonka Balonka',
            'date_of_birth' => '1965-01-13',
            'weight' => 76.5, 
            'height' => 185, 
            'gender' => 'female',
            'fitness_goal' => 'weight_loss', 
            'weekly_exercise_frequency' => 'lightly_active',
            'profile_image'=>'user_images/user1.jpg'
        ]);

        UserProfile::create([
            'user_id' => 2, 
            'name' => 'Maria Smith',
            'date_of_birth' => '2002-11-04',
            'weight' => 63.7, 
            'height' => 160, 
            'gender' => 'female',
            'fitness_goal' => 'maintenance', 
            'weekly_exercise_frequency' => 'sedentary',
            'profile_image'=>'user_images/user2.jpg'

        ]);

        UserProfile::create([
            'user_id' => 3, 
            'name' => 'John Wick',
            'date_of_birth' => '1990-07-25',
            'weight' => 85.2, 
            'height' => 175, 
            'gender' => 'male',
            'fitness_goal' => 'build_muscle', 
            'weekly_exercise_frequency' => 'very_active',
            'profile_image'=>'user_images/user3.jpg'

        ]);

        UserProfile::create([
            'user_id' => 4, 
            'name' => 'Keshav Kumar',
            'date_of_birth' => '2003-02-06',
            'weight' => 65, 
            'height' => 176, 
            'gender' => 'male',
            'fitness_goal' => 'build_muscle', 
            'weekly_exercise_frequency' => 'very_active',
            'daily_goal_ml' => 2300,
            'daily_goal_calories'=>2801 ,
              'profile_image'=>'user_images/user4.jpg'
        ]);


    }
}
