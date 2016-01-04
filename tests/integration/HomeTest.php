<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Check that front page is available for visitors.
     *
     * @return void
     */
    public function testFrontPage()
    {
        // Visitors should see front page without links to admin.
        $this->visit('/')
            ->see('webCalendar')
            ->dontSee(route('admin.courses.index'));

        $this->assertResponseOk();
    }

    /**
     * Check that front page is available for users.
     *
     * @return void
     */
    public function testFrontPageForUser()
    {
        // Logged in users should see link to admin.
        $user = factory(\WebCalendar\User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see('webCalendar')
            ->see(route('admin.courses.index'));

        $this->assertResponseOk();
    }

    /**
     * Only courses with active modules should be shown on front page.
     *
     * @return void
     */
    public function testOnlyActiveCourses()
    {
        $courses = factory(\WebCalendar\Course::class, 3)->create();

        // Add active module to first course.
        $courses->first()->modules()->attach(factory(\WebCalendar\Module::class, 'active')->create());

        // Add inactive module to last course.
        $courses->last()->modules()->attach(factory(\WebCalendar\Module::class, 'inactive')->create());

        // See course with active module, don't see course without modules or with inactive module.
        $this->visit('/')
            ->see($courses->first()->code)
            ->dontSee($courses->get(1)->code)
            ->dontSee($courses->last()->code);
    }
}
