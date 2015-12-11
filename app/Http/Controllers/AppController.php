<?php

namespace WebCalendar\Http\Controllers;

use WebCalendar\Course;

class AppController extends Controller
{
    public function index()
    {
        $courses = Course::active()->get();

        return view('home')
            ->with('courses', $courses);
    }

    public function admin()
    {
        $courses = Course::all();

        return view('admin')
            ->with('courses', $courses);
    }
}
