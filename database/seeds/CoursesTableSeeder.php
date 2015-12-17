<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use WebCalendar\Course;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $courses = [];

        foreach (range(1, 10) as $index) {
            $courses[] = [
                'name' => trim($faker->sentence(rand(1, 3)), ' .'),
                'code' => $faker->unique()->bothify('??#0##')
            ];
        }

        Course::insert($courses);
    }
}