<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create( [ 
            'conversation_id'=>1,
            'sender_id'=>1,
            'receiver_id'=>1,
            'content'=>'hell how r u',
            'is_read'=>true
        ] );  

        Message::create( [ 
            'conversation_id'=>1,
            'sender_id'=>2,
            'receiver_id'=>2,
            'content'=>'i need help with my diet',

            'is_read'=>true
        ] ); 

    }
}
