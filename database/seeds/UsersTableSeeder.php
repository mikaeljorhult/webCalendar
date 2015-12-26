<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(WebCalendar\User::class)->create([
            'username' => 'test',
            'password' => env('DEFAULT_PASSWORD'),
            'email' => 'test@test.com'
        ]);

        factory(WebCalendar\User::class, 10)->create();
    }
}