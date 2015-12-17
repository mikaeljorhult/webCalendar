<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use WebCalendar\Lesson;
use WebCalendar\Module;

class LessonsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $modules = Module::all();
        $lessons = [];

        // For each module.
        foreach ($modules as $module) {
            // Create between 10 and 100 lessons.
            foreach (range(1, rand(10, 100)) as $lesson) {
                $date = $faker->dateTimeBetween($module->start_date->format('Y-m-d') . ' 00:00:00',
                    $module->end_date->format('Y-m-d') . ' 00:00:00');
                $start_time = $faker->dateTimeBetween($date->format('Y-m-d 00:00:00'), $date->format('Y-m-d 23:00:00'));
                $end_time = $faker->dateTimeBetween($start_time, $date->format('Y-m-d 23:59:59'));

                $lessons[] = [
                    'module_id' => $module->id,
                    'title' => trim($faker->sentence(rand(1, 5)), ' .'),
                    'location' => $faker->word() . ', Mediehuset',
                    'description' => $faker->paragraph(),
                    'start_time' => $start_time->format('Y-m-d H:i:s'),
                    'end_time' => $end_time->format('Y-m-d H:i:s'),
                ];
            }
        }

        Lesson::insert($lessons);
    }
}