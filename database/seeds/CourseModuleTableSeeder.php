<?php

use Illuminate\Database\Seeder;

class CourseModuleTableSeeder extends Seeder
{
    public function run()
    {
        $entries = [];

        // For each course.
        foreach (range(1, 10) as $course) {
            // Variable for sort order.
            $counter = 0;

            // For each module.
            foreach (range(1, 30) as $module) {
                // 50% chance that the module should belong to course.
                if (rand(0, 10) > 9) {
                    $entries[] = [
                        'course_id' => $course,
                        'module_id' => $module,
                        'sort_order' => ++$counter
                    ];
                }
            }
        }

        DB::table('course_module')->insert($entries);
    }
}