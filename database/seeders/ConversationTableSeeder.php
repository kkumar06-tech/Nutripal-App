<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Conversation::create( [ 
            'user_profile_id'=>1,
            'nutritionist_id'=>1,
        ] ); 
        Conversation::create( [ 
            'user_profile_id'=>2,
            'nutritionist_id'=>2,
        ] ); 
    }
}
