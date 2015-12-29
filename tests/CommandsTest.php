<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;

class CommandsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Command should work with no courses in database.
     *
     * @return void
     */
    public function testCacheCalendarsCommandWithNoCourses()
    {
        // Setup expectations for cache facade.
        Cache::shouldReceive('rememberForever')
            ->never();

        // Run command.
        $this->artisan('calendars:cache');

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * Command should work with no active courses in database.
     *
     * @return void
     */
    public function testCacheCalendarsCommandWithNoActiveCourses()
    {
        // Store two courses in database.
        $courses = factory(\WebCalendar\Course::class, 2)->create();

        // Add active module to first and last course.
        $courses->first()->modules()->attach(factory(\WebCalendar\Module::class, 'inactive')->create());

        // Setup expectations for cache facade.
        Cache::shouldReceive('rememberForever')
            ->never();

        // Run command.
        $this->artisan('calendars:cache');

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * Active courses should be cached.
     *
     * @return void
     */
    public function testCacheCalendarsCommandWithActiveCourses()
    {
        // Store three courses in database.
        $courses = factory(\WebCalendar\Course::class, 3)->create();

        // Add active module to first and last course.
        $courses->first()->modules()->attach(factory(\WebCalendar\Module::class, 'active')->create());
        $courses->last()->modules()->attach(factory(\WebCalendar\Module::class, 'active')->create());

        // Setup expectations for cache facade.
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('schedule.' . $courses->first()->code, \Mockery::on(function ($value) {
               return $value instanceof Closure;
            }));

        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('schedule.' . $courses->last()->code, \Mockery::on(function ($value) {
                return $value instanceof Closure;
            }));

        // Run command.
        $this->artisan('calendars:cache');

        // Finish test.
        $this->assertTrue(true);
    }
}
