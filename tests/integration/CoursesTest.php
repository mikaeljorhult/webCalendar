<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CoursesTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    /**
     * Check that courses index is available.
     *
     * @return void
     */
    public function testIndex()
    {
        $courses = factory(\WebCalendar\Course::class, 10)->create();

        $this->visit(route('admin.courses.index'))
            ->seePageIs(route('admin.courses.index'))
            ->see($courses->first()->name);

        $this->assertResponseOk();
    }

    /**
     * Check that course can be edited from index page.
     *
     * @return void
     */
    public function testIndexEdit()
    {
        $course = factory(\WebCalendar\Course::class, 1)->create();

        $this->visit(route('admin.courses.index'))
            ->see($course->name)
            ->click(trans('messages.edit'))
            ->seePageIs(route('admin.courses.edit', [$course]));

        $this->assertResponseOk();
    }

    /**
     * Check that course can be deleted from index page.
     *
     * @return void
     */
    public function testIndexDestroy()
    {
        $course = factory(\WebCalendar\Course::class, 1)->create();

        $this->visit(route('admin.courses.index'))
            ->see($course->name)
            ->press(trans('messages.delete'))
            ->seePageIs(route('admin.courses.index'))
            ->dontSee($course->name);

        $this->assertResponseOk();
    }

    /**
     * Check that single courses view is available.
     *
     * @return void
     */
    public function testShow()
    {
        $course = factory(\WebCalendar\Course::class, 1)->create();

        $this->visit(route('admin.courses.show', [$course]))
            ->seePageIs(route('admin.courses.show', [$course]))
            ->see($course->name);

        $this->assertResponseOk();
    }

    /**
     * Check that edit view is available.
     *
     * @return void
     */
    public function testEdit()
    {
        $course = factory(\WebCalendar\Course::class, 1)->create();

        $this->visit(route('admin.courses.edit', [$course]))
            ->seePageIs(route('admin.courses.edit', [$course]))
            ->see($course->name);

        $this->assertResponseOk();
    }

    /**
     * Check that course can be updated.
     *
     * @return void
     */
    public function testUpdate()
    {
        $course = factory(\WebCalendar\Course::class, 1)->create([
            'name' => 'Old name'
        ]);

        $this->visit(route('admin.courses.edit', [$course]))
            ->seePageIs(route('admin.courses.edit', [$course]))
            ->see($course->name)
            ->type('New name', 'name')
            ->press(trans('messages.update'))
            ->seePageIs(route('admin.courses.index'))
            ->see('New name');

        $this->assertResponseOk();
    }

    /**
     * Check that course can be created.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->visit(route('admin.courses.create'))
            ->type('New name', 'name')
            ->type('test0001', 'code')
            ->press(trans('messages.create-course'))
            ->seePageIs(route('admin.courses.index'))
            ->see('New name');

        $this->assertResponseOk();
    }
}
