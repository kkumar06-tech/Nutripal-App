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
            'password'=>'j3ne9j',
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
                'role'=>'nutritionist'
            ] ); 
    }
}
