<?php

namespace Database\Seeders;


use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'user_profile_id' => 1, // User who requested the chat
            'nutritionist_id' => 2, // Nutritionist receiving the request
            'message' => 'requests a chat',
            'type' => 'chat',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        
        Notification::create([
            'user_profile_id' => 3,
            'nutritionist_id' => 1,
            'message' => 'requests an appointment',
            'type' => 'appointment',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

       
        Notification::create([
            'user_profile_id' => 2,
            'nutritionist_id' => 3,
            'message' => 'appointment confirmed',
            'type' => 'appointment',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
