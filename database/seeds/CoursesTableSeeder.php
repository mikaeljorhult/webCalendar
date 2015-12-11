<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use WebCalendar\Course;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Course::create([
                'name' => trim($faker->sentence(rand(1, 3)), ' .'),
                'code' => $faker->unique()->bothify('??#0##')
            ]);
        }
    }
}