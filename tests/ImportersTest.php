<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImportersTest extends TestCase
{
    /**
     * Check that test function return true if able to connect to URL.
     *
     * @return void
     */
    public function testGoogleCalendarTestMethod()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make();

        // Mock empty 200 OK response.
        $this->setHttpResponses();

        // Google Calendar importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\GoogleCalendar', [$module]);

        // Will be able to connect and should return true.
        $this->assertTrue($importer->test());
    }

    /**
     * Any failed attempts to retrieve calendar should be logged.
     *
     * @return void
     */
    public function testGoogleCalendarFailedRetrieval()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make();

        // Mock Log facade.
        \Log::shouldReceive('error')
            ->once();

        // Mock 404 Not Found response.
        $json = view('tests.google-404')->render();

        $this->setHttpResponses([
            new Response(404, [], $json)
        ]);

        // Google Calendar importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\GoogleCalendar', [$module]);

        // Parse and return event from source.
        $events = $importer->get();

        // Method should return false.
        $this->assertFalse($events);
    }

    /**
     * An empty response should work.
     *
     * @return void
     */
    public function testGoogleCalendarEmpty()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make();

        // Mock empty 200 OK response.
        $this->setHttpResponses([
            new Response(200, [], '{}')
        ]);

        // Google Calendar importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\GoogleCalendar', [$module]);

        // Should return false for empty responses.
        $this->assertFalse($importer->get());
    }

    /**
     * Importer should parse response content and return events.
     *
     * @return void
     */
    public function testGoogleCalendarWithEvents()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make();

        // Mock 200 OK response with events.
        $json = view('tests.google')->render();

        $this->setHttpResponses([
            new Response(200, [], $json)
        ]);

        // Google Calendar importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\GoogleCalendar', [$module]);

        // Parse and return event from source.
        $events = $importer->get();

        // Array should contain 1 event.
        $this->assertTrue(is_array($events));
        $this->assertCount(1, $events);
        $this->assertEquals('Event title', $events[0]['title']);
        $this->assertEquals('Event description', $events[0]['description']);
        $this->assertEquals('Event location', $events[0]['location']);
    }

    /**
     * Check that test function return true if able to connect to URL.
     *
     * @return void
     */
    public function testICalTestMethod()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'ical',
        ]);

        // Mock empty 200 OK response.
        $this->setHttpResponses();

        // iCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\ICal', [$module]);

        // Will be able to connect and should return true.
        $this->assertTrue($importer->test());
    }

    /**
     * Any failed attempts to retrieve calendar should be logged.
     *
     * @return void
     */
    public function testICalFailedRetrieval()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'ical'
        ]);

        // Mock Log facade.
        \Log::shouldReceive('error')
            ->once();

        // Mock 404 Not Found response.
        $this->setHttpResponses([
            new Response(404, [], '')
        ]);

        // iCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\ICal', [$module]);

        // Parse and return event from source.
        $events = $importer->get();

        // Method should return false.
        $this->assertFalse($events);
    }

    /**
     * An empty response should work.
     *
     * @return void
     */
    public function testICalEmpty()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'ical',
        ]);

        // Mock empty 200 OK response.
        $this->setHttpResponses();

        // iCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\ICal', [$module]);

        // Should return false for empty responses.
        $this->assertFalse($importer->get());
    }

    /**
     * Importer should parse response content and return events.
     * Should ignore events not within module start and end dates.
     *
     * @return void
     */
    public function testICalWithEvents()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'ical',
            'start_date' => \Carbon\Carbon::now()->subMonth(),
            'end_date' => \Carbon\Carbon::now()->addMonth()
        ]);

        // Mock 200 OK response with events.
        $ical = view('tests.ical')->render();

        $this->setHttpResponses([
            new Response(200, [], $ical)
        ]);

        // iCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\ICal', [$module]);

        // Parse and return event from source.
        $events = $importer->get();

        // Array should contain 1 event.
        $this->assertTrue(is_array($events));
        $this->assertCount(1, $events);
        $this->assertEquals('Event title', $events[0]['title']);
        $this->assertEquals('Event description', $events[0]['description']);
        $this->assertEquals('Event location', $events[0]['location']);
    }

    /**
     * Check that test function return true if able to connect to URL.
     *
     * @return void
     */
    public function testWebCalTestMethod()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'webcal',
        ]);

        // Mock empty 200 OK response.
        $this->setHttpResponses();

        // WebCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\WebCal', [$module]);

        // Will be able to connect and should return true.
        $this->assertTrue($importer->test());
    }

    /**
     * Any failed attempts to retrieve calendar should be logged.
     *
     * @return void
     */
    public function testWebCalFailedRetrieval()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'webcal'
        ]);

        // Mock Log facade.
        \Log::shouldReceive('error')
            ->once();

        // Mock 404 Not Found response.
        $this->setHttpResponses([
            new Response(404, [], '')
        ]);

        // WebCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\WebCal', [$module]);

        // Parse and return event from source.
        $events = $importer->get();

        // Method should return false.
        $this->assertFalse($events);
    }

    /**
     * An empty response should work.
     *
     * @return void
     */
    public function testWebCalEmpty()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'webcal',
        ]);

        // Mock empty 200 OK response.
        $this->setHttpResponses();

        // WebCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\WebCal', [$module]);

        // Should return false for empty responses.
        $this->assertFalse($importer->get());
    }

    /**
     * Importer should parse response content and return events.
     * Should ignore events not within module start and end dates.
     *
     * @return void
     */
    public function testWebCalWithEvents()
    {
        $module = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'webcal',
            'start_date' => \Carbon\Carbon::now()->subMonth(),
            'end_date' => \Carbon\Carbon::now()->addMonth()
        ]);

        // Mock 200 OK response with events. Same format as iCal.
        $ical = view('tests.ical')->render();

        $this->setHttpResponses([
            new Response(200, [], $ical)
        ]);

        // WebCal importer for mocked module.
        $importer = app()->make('\WebCalendar\Importers\WebCal', [$module]);

        // Parse and return event from source.
        $events = $importer->get();

        // Array should contain 1 event.
        $this->assertTrue(is_array($events));
        $this->assertCount(1, $events);
        $this->assertEquals('Event title', $events[0]['title']);
        $this->assertEquals('Event description', $events[0]['description']);
        $this->assertEquals('Event location', $events[0]['location']);
    }
}
