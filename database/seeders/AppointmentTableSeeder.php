<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appointment::create([
            'user_profile_id' => 1,  // Hardcoded user profile ID
            'nutritionist_profile_id' => 1,  // Hardcoded nutritionist ID
            'date' => '2024-12-05',   // Fixed date
            'time' => '10:00:00',     // Fixed time
        ]);

        Appointment::create([
            'user_profile_id' => 2,  // Hardcoded user profile ID
            'nutritionist_profile_id' => 2,  // Hardcoded nutritionist ID
            'date' => '2024-12-05',   // Fixed date
            'time' => '09:00:00',     // Fixed time
        ]);
    }
    }

