<?php

namespace WebCalendar\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use WebCalendar\Course;
use WebCalendar\Generators\ScheduleGenerator;

class CacheCalendarsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendars:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache calendars for active courses.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ScheduleGenerator $generator
     * @return mixed
     */
    public function handle(ScheduleGenerator $generator)
    {
        $this->info('Caching all active courses.');

        // Get all active courses
        $courses = Course::active()->get();

        // Go through and cache calendar for each course.
        if (count($courses) > 0) {
            foreach ($courses as $course) {
                $this->line('Caching course: ' . $course->name . '...');

                // Generate schedule for course and cache output.
                Cache::rememberForever('schedule.' . $course->code, function () use ($generator, $course) {
                    return $generator->generate($course);
                });
            }

            $this->info('Cached ' . count($courses) . ' courses.');
        } else {
            $this->info('No courses to cache.');
        }
    }
}
