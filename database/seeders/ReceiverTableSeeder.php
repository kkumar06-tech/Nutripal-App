<?php

namespace Database\Seeders;

use App\Models\receiver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        receiver::create( [ 
            'user_id'=>'1',
            'content'=>'hello',
        ] ); 
        receiver::create( [ 
            'user_id'=>'2',
            'content'=>'hello, my patient',
        ] ); 
    }
}
