<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        factory(WebCalendar\Course::class, 10)->create();
    }
}