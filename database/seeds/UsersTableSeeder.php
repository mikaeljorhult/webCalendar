<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(WebCalendar\User::class, 10)->create([
            'username' => 'test',
            'password' => getenv('DEFAULT_PASSWORD'),
            'email' => 'test@test.com'
        ]);
    }
}