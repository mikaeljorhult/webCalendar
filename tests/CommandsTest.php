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

    /**
     * No course should be cached if non-existing course code is passed to command.
     *
     * @return void
     */
    public function testCacheCalendarsCommandWithNonExistingCourse()
    {
        // Store three courses in database.
        $courses = factory(\WebCalendar\Course::class, 3)->create();

        // Add active module to first and last course.
        $courses->first()->modules()->attach(factory(\WebCalendar\Module::class, 'active')->create());
        $courses->last()->modules()->attach(factory(\WebCalendar\Module::class, 'active')->create());

        // Setup expectations for cache facade.
        Cache::shouldReceive('rememberForever')
            ->never();

        // Run command.
        $this->artisan('calendars:cache', [
            'code' => ['test-course']
        ]);

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * If supplied, only supplied courses should be cached.
     *
     * @return void
     */
    public function testCacheCalendarsCommandWithExistingCourse()
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

        // Run command.
        $this->artisan('calendars:cache', [
            'code' => [$courses->first()->code]
        ]);

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * Command should work with no modules in database.
     *
     * @return void
     */
    public function testFetchCalendarsCommandWithNoModules()
    {
        // Run command.
        $this->artisan('calendars:fetch');

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * Command should work with no active modules in database.
     *
     * @return void
     */
    public function testFetchCalendarsCommandWithNoActiveModules()
    {
        // Mock importer class.
        $importer = \Mockery::mock('\WebCalendar\Importers\GoogleCalendar', function ($mock) {
            // Importer should be called once for each active module. Never.
            $mock->shouldReceive('get')
                ->never()
                ->andReturn(false);
        });

        // Replace importer with mock in service container.
        app()->instance('\WebCalendar\Importers\GoogleCalendar', $importer);

        // Create three inactive modules in database.
        factory(\WebCalendar\Module::class, 'inactive', 3)->create();

        // Run command.
        $this->artisan('calendars:fetch');

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * Active modules should be fetched.
     *
     * @return void
     */
    public function testFetchCalendarsCommandWithActiveModules()
    {
        // Create two active modules in database.
        $modules = factory(\WebCalendar\Module::class, 'active', 2)->create();

        // Create three active modules in database.
        factory(\WebCalendar\Module::class, 'inactive', 3)->create();

        // Create mock lessons to fetch.
        $lessons = factory(\WebCalendar\Lesson::class, 2)->make([
            'module_id' => $modules->first()->id,
            'start_time' => \Carbon\Carbon::now()->addHours(1),
            'end_time' => \Carbon\Carbon::now()->addHours(2)
        ])->toArray();

        // Mock importer class.
        $importer = \Mockery::mock('\WebCalendar\Importers\GoogleCalendar', function ($mock) use ($lessons) {
            // Importer should be called once for each active module.
            $mock->shouldReceive('get')
                ->once()
                ->andReturn($lessons);

            $mock->shouldReceive('get')
                ->once()
                ->andReturn(false);
        });

        // Replace importer with mock in service container.
        app()->instance('\WebCalendar\Importers\GoogleCalendar', $importer);

        // Run command.
        $this->artisan('calendars:fetch');

        // Finish test.
        $this->assertCount(2, \WebCalendar\Lesson::all());
        $this->seeInDatabase('lessons', $lessons[0]);
        $this->seeInDatabase('lessons', $lessons[1]);
    }

    /**
     * No module should be cached if non-existing module id is passed to command.
     *
     * @return void
     */
    public function testFetchCalendarsCommandWithNonExistingModule()
    {
        // Create two active and three inactive modules in database.
        factory(\WebCalendar\Module::class, 'active', 2)->create();
        factory(\WebCalendar\Module::class, 'inactive', 3)->create();

        // Mock importer class.
        $importer = \Mockery::mock('\WebCalendar\Importers\GoogleCalendar', function ($mock) {
            // Importer should be called once for each supplied existing module. Never.
            $mock->shouldReceive('get')
                ->never()
                ->andReturn(false);
        });

        // Replace importer with mock in service container.
        app()->instance('\WebCalendar\Importers\GoogleCalendar', $importer);

        // Run command.
        $this->artisan('calendars:fetch', [
            'id' => [100]
        ]);

        // Finish test.
        $this->assertTrue(true);
    }

    /**
     * If supplied, only supplied module should be cached.
     *
     * @return void
     */
    public function testFetchCalendarsCommandWithExistingModule()
    {
        // Create two active and three inactive modules in database.
        $modules = factory(\WebCalendar\Module::class, 'active', 2)->create();
        factory(\WebCalendar\Module::class, 'inactive', 3)->create();

        // Mock importer class.
        $importer = \Mockery::mock('\WebCalendar\Importers\GoogleCalendar', function ($mock) {
            // Importer should be called once for each supplied module.
            $mock->shouldReceive('get')
                ->once()
                ->andReturn(false);
        });

        // Replace importer with mock in service container.
        app()->instance('\WebCalendar\Importers\GoogleCalendar', $importer);

        // Run command.
        $this->artisan('calendars:fetch', [
            'id' => [$modules->first()->id]
        ]);

        // Finish test.
        $this->assertTrue(true);
    }
}
