<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $webcal = factory(\WebCalendar\Module::class, 'active')->make(['type' => 'webcal']);

        $this->assertInstanceOf(\WebCalendar\Importers\GoogleCalendar::class, $google->importer());
        $this->assertInstanceOf(\WebCalendar\Importers\ICal::class, $ical->importer());
        $this->assertInstanceOf(\WebCalendar\Importers\WebCal::class, $webcal->importer());
    }
}
