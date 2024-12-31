<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create( [ 
            'username'=>'keshav',
            'email'=>'kk12@gmail.com',
            'password'=>'123456789',
            'role'=>'user'
            ] ); 

        User::create( [ 
                'username'=>'anshu',
                'email'=>'anshu12@gmail.com',
                'password'=> bcrypt('sdw212wse9j'),
                'role'=>'user'
            ] ); 

        User::create( [ 
                'username'=>'Cena orton',
                'email'=>'cowwe@gmail.com',
                'password'=> bcrypt('cowwe2wse9j'),
                'role'=>'user'
            ] ); 

            User::create( [ 
                'username'=>'ondrej',
                'email'=>'ondrej@gmail.com',
                'password'=> bcrypt('1232wse9j'),
                'role'=>'nutritionist'
                ] ); 
               
                User::create( [ 
                    'username'=>'aastha',
                    'email'=>'aasthaj@gmail.com',
                    'password'=> bcrypt('123456789'),
                    'role'=>'nutritionist'

            ] ); 
                User::create( [ 
                    'username'=>'nana',
                    'email'=>'mvolod00@gmail.com',
                    'password'=> bcrypt('omglola'),
                    'role'=>'user'

            ] ); 
    }
}
