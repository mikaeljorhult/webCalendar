<?php

namespace WebCalendar\Generators;

use WebCalendar\Lesson;

class ScheduleGenerator
{
    public function generate($course) {
        $sort_order = [];
        $modules = $course->modules;

        $lessons = Lesson::whereIn('module_id', $modules->pluck('id'))
            ->with('module')
            ->orderBy('start_time', 'ASC')
            ->orderBy('title', 'ASC')
            ->get();

        foreach ($modules as $module) {
            $sort_order[$module->id] = $module->pivot->sort_order;
        }

        return view('courses.schedule')
            ->with('course', $course)
            ->with('modules', $modules)
            ->with('lessons', $lessons)
            ->with('sort_order', $sort_order)
            ->render();
    }
}