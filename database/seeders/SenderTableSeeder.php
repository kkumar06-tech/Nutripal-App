<?php

namespace Database\Seeders;

use App\Models\sender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        sender::create( [ 
            'user_id'=>'1',
            'content'=>'hello',
        ] ); 
        sender::create( [ 
            'user_id'=>'2',
            'content'=>'hello, my patient',
        ] ); 
    }
}
