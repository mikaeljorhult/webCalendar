<?php

namespace WebCalendar\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \WebCalendar\Console\Commands\CacheCalendarsCommand::class,
        \WebCalendar\Console\Commands\FetchCalendarsCommand::class,
        \WebCalendar\Console\Commands\UpdateCalendarsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //->hourly();
    }
}
