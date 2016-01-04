<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CourseTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Only courses with active modules attached should be considered active.
     *
     * @return void
     */
    public function testActiveScope()
    {
        // Store 3 courses in database.
        $courses = factory(\WebCalendar\Course::class, 3)->create();

        // Add active module to first course.
        $courses->first()->modules()->attach(factory(\WebCalendar\Module::class, 'active')->create());

        // Add inactive module to last course.
        $courses->last()->modules()->attach(factory(\WebCalendar\Module::class, 'inactive')->create());

        // Get all courses with active modules.
        $activeCourses = \WebCalendar\Course::active()->get();

        $this->assertCount(1, $activeCourses);
        $this->assertEquals($courses->first()->id, $activeCourses->first()->id);
    }
}
