<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneratorsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Generator should output view HTML.
     *
     * @return void
     */
    public function testGeneratorOutput()
    {
        // Create a course and add two modules to it.
        $course = factory(\WebCalendar\Course::class)->create(['name' => 'New course']);
        $course->modules()->attach(factory(\WebCalendar\Module::class)->create());
        $course->modules()->attach(factory(\WebCalendar\Module::class)->create());

        // Instantiate generator.
        $generator = new \WebCalendar\Generators\ScheduleGenerator();
        $output = $generator->generate($course);

        $this->assertTrue(is_string($output));
        $this->assertContains('<h1>New course</h1>', $output);
        $this->assertContains('input type="checkbox" name="' . $course->code . '_module-1"', $output);
    }
}
