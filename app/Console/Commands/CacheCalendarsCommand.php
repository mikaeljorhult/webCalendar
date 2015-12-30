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
    protected $signature = 'calendars:cache {code?*}';

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
        $this->info('Caching courses.');

        // Get all active courses
        $courses = $this->courses();

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

    /**
     * Determine which courses should be cached based on command arguments.
     * Defaults to all active.
     *
     * @return mixed
     */
    private function courses()
    {
        // Get supplied argument.
        $code = $this->argument('code');

        // Fetch courses by code if present.
        if ($code !== []) {
            return Course::whereIn('code', $code)->get();
        } else {
            // Default to all active courses.
            return Course::active()->get();
        }
    }
}
