<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use WebCalendar\Module;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            $start_date = $faker->dateTimeBetween('-1 month', '+1 month');

            Module::create([
                'name' => trim($faker->sentence(rand(1, 3)), ' .'),
                'start_date' => $start_date->format('Y-m-d'),
                'end_date' => $faker->dateTimeBetween($start_date, '+1 month')->format('Y-m-d'),
                'calendar' => 'http://google.se'
            ]);
        }
    }
}