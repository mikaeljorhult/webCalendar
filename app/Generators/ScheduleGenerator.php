<?php

namespace WebCalendar\Generators;

use WebCalendar\Lesson;

class ScheduleGenerator
{
    public function generate($course)
    {
        $sortOrder = $course->modules->pluck('pivot.sort_order', 'id');

        $lessons = Lesson::whereIn('module_id', $course->modules->pluck('id'))
            ->with('module')
            ->orderBy('start_time', 'ASC')
            ->orderBy('title', 'ASC')
            ->get();

        return view('courses.schedule-content')
            ->with('course', $course)
            ->with('modules', $course->modules)
            ->with('lessons', $lessons)
            ->with('sort_order', $sortOrder)
            ->render();
    }
}