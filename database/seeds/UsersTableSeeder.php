<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'test',
            'password' => Hash::make(getenv('DEFAULT_PASSWORD')),
            'email' => 'test@test.com'
        ]);
    }
}