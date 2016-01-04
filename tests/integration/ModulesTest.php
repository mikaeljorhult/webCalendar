<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ModulesTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    /**
     * Check that modules index is available.
     *
     * @return void
     */
    public function testIndex()
    {
        $modules = factory(\WebCalendar\Module::class, 10)->create();

        $this->visit(route('admin.modules.index'))
            ->seePageIs(route('admin.modules.index'))
            ->see($modules->first()->name);

        $this->assertResponseOk();
    }

    /**
     * Check that module can be edited from index page.
     *
     * @return void
     */
    public function testIndexEdit()
    {
        $module = factory(\WebCalendar\Module::class, 1)->create();

        $this->visit(route('admin.modules.index'))
            ->see($module->name)
            ->click(trans('messages.edit'))
            ->seePageIs(route('admin.modules.edit', [$module]));

        $this->assertResponseOk();
    }

    /**
     * Check that module can be deleted from index page.
     *
     * @return void
     */
    public function testIndexDestroy()
    {
        $module = factory(\WebCalendar\Module::class, 1)->create([
            'name' => 'New module'
        ]);

        $this->visit(route('admin.modules.index'))
            ->see($module->name)
            ->press(trans('messages.delete'))
            ->seePageIs(route('admin.modules.index'))
            ->dontSee($module->name);

        $this->assertResponseOk();
    }

    /**
     * Check that single modules view is available.
     *
     * @return void
     */
    public function testShow()
    {
        $module = factory(\WebCalendar\Module::class, 1)->create();

        $this->visit(route('admin.modules.show', [$module]))
            ->seePageIs(route('admin.modules.show', [$module]))
            ->see($module->name);

        $this->assertResponseOk();
    }

    /**
     * Check that edit view is available.
     *
     * @return void
     */
    public function testEdit()
    {
        $module = factory(\WebCalendar\Module::class, 1)->create();

        $this->visit(route('admin.modules.edit', [$module]))
            ->seePageIs(route('admin.modules.edit', [$module]))
            ->see($module->name);

        $this->assertResponseOk();
    }

    /**
     * Check that module can be updated.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->setHttpResponses();

        $module = factory(\WebCalendar\Module::class, 1)->create([
            'name' => 'Old name',
            'calendar' => route('home')
        ]);

        $this->visit(route('admin.modules.edit', [$module]))
            ->seePageIs(route('admin.modules.edit', [$module]))
            ->see($module->name)
            ->type('New name', 'name')
            ->press(trans('messages.update'))
            ->seePageIs(route('admin.modules.index'))
            ->see('New name');

        $this->assertResponseOk();
    }

    /**
     * Check that module can be created.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->setHttpResponses();

        $this->visit(route('admin.modules.create'))
            ->type('New name', 'name')
            ->type(date('Y-m-d'), 'start_date')
            ->type(date('Y-m-d'), 'end_date')
            ->select('ical', 'type')
            ->type(route('home'), 'calendar')
            ->press(trans('messages.create-module'))
            ->seePageIs(route('admin.modules.index'))
            ->see('New name');

        $this->assertResponseOk();
    }
}
