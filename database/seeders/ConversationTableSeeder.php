<?php

namespace Database\Seeders;

use App\Models\conversation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        conversation::create( [ 
            'user_id'=>'1',
            'sender_id'=>'1',
            'receiver_id'=>'2',
            'content'=>'hello'
        ] ); 
        conversation::create( [ 
            'user_id'=>'2',
            'sender_id'=>'2',
            'receiver_id'=>'1',
            'content'=>'hello, my patient'
        ] ); 
    }
}
