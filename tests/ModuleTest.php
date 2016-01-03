<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;

class ModuleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Modules are considered active if current time is between its start and end date.
     *
     * @return void
     */
    public function testActiveScope()
    {
        // Create one active module.
        $module = factory(\WebCalendar\Module::class, 'active')->create();

        // Create five inactive modules.
        factory(\WebCalendar\Module::class, 'inactive', 5)->create();

        // Get all active modules.
        $activeModules = \WebCalendar\Module::active()->get();

        $this->assertCount(1, $activeModules);
        $this->assertEquals($module->id, $activeModules->first()->id);
    }

    /**
     * See that correct importer is returned for each calendar type.
     *
     * @return void
     */
    public function testImporters()
    {
        // Create modules of each type of calendar.
        $google = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'google']);
        $ical = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'ical']);
        $icalFile = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'ical-file']);
        $webcal = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'webcal']);

        $this->assertInstanceOf(\WebCalendar\Importers\GoogleCalendar::class, $google->importer());
        $this->assertInstanceOf(\WebCalendar\Importers\ICal::class, $ical->importer());
        $this->assertInstanceOf(\WebCalendar\Importers\ICalFile::class, $icalFile->importer());
        $this->assertInstanceOf(\WebCalendar\Importers\WebCal::class, $webcal->importer());
    }

    /**
     * Check that test function return true if able to connect to URL.
     *
     * @return void
     */
    public function testModuleTestMethod()
    {
        // Create modules of each type of calendar.
        $google = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'google']);
        $ical = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'ical']);
        $icalFile = factory(\WebCalendar\Module::class, 'active')->make([
            'type' => 'ical-file',
            'calendar' => 'test-ical.ics'
        ]);
        $webcal = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'webcal']);

        // Mock empty 200 OK response.
        $this->setHttpResponses([
            new Response(200, []),
            new Response(200, []),
            new Response(200, [])
        ]);

        // Create file for testing iCal.
        Storage::put(
            'test-ical.ics',
            view('tests.ical')->render()
        );

        // Will be able to connect and should return true.
        $this->assertTrue($google->test());
        $this->assertTrue($ical->test());
        $this->assertTrue($icalFile->test());
        $this->assertTrue($webcal->test());

        // Remove test file after test is done.
        Storage::delete('test-ical.ics');
    }

    /**
     * Files attached to a module should be stored.
     *
     * @return void
     */
    public function testAddingFile()
    {
        // Create file for testing iCal.
        Storage::put(
            'test-ical.ics',
            view('tests.ical')->render()
        );

        // Create one active module.
        $module = factory(\WebCalendar\Module::class, 'active')->create();

        // Mock an uploaded file.
        $file = Mockery::mock('\Symfony\Component\HttpFoundation\File\UploadedFile', [
            'getClientOriginalName' => 'test-ical.ics',
            'getClientOriginalExtension' => 'ics',
            'getRealPath' => storage_path('app/test-ical.ics')
        ]);

        // Attach file.
        $module->addFile($file);

        $this->assertTrue(Storage::has($module->calendar));
        $this->assertEquals(Storage::get('test-ical.ics'), Storage::get($module->calendar));

        // Delete temporary test files.
        Storage::delete(['test-ical.ics', $module->calendar]);
    }
}
