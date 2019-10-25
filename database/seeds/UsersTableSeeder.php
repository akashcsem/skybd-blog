<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id'    => 1,
            'name'       => "Asm Akash",
            'username'   => "admin",
            'email'      => "akashcseuu026@gmail.com",
            'password'   => Hash::make("123456789"),
        ]);
        
        User::create([
            'role_id'    => 2,
            'name'       => "Roquib Babu",
            'username'   => "Roquib",
            'email'      => "roquib@gmail.com",
            'password'   => Hash::make("123456789"),
        ]);
    }
}
