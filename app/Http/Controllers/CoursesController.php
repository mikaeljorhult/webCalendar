<?php

namespace WebCalendar\Http\Controllers;

use Illuminate\Support\Facades\Request;
use WebCalendar\Course;
use WebCalendar\Http\Requests\CourseCreateRequest;
use WebCalendar\Http\Requests\CourseUpdateRequest;
use WebCalendar\Lesson;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = Course::all();

        return view('courses.index')
            ->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseCreateRequest $request
     * @return Response
     */
    public function store(CourseCreateRequest $request)
    {
        Course::create($request->all());

        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $code
     * @return Response
     */
    public function display($code)
    {
        $course = Course::where('code', '=', $code)->first();
        $sort_order = [];

        if ($course) {
            $modules = $course->modules()->get();

            $module_id = $course->modules()->lists('module_id');
            $lessons = Lesson::whereIn('module_id', $module_id)
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
                ->with('sort_order', $sort_order);
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return Response
     */
    public function show(Course $course)
    {
        $modules = $course->modules()->with('lessons')->get();

        $module_id = $course->modules()->lists('module_id');
        $lessons = Lesson::whereIn('module_id', $module_id)->orderBy('start_time', 'ASC')->orderBy('title', 'ASC')->get();

        return view('courses.view')
            ->with('course', $course)
            ->with('modules', $modules)
            ->with('lessons', $lessons);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit')
            ->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Course $course
     * @param CourseUpdateRequest $request
     * @return Response
     */
    public function update(Course $course, CourseUpdateRequest $request)
    {
        $course->fill($request->all());

        if ($request->has('modules')) {
            $modules = $request->input('modules');
            $sort_order = 1;

            foreach ($modules as $module) {
                $course->modules()->updateExistingPivot($module, ['sort_order' => $sort_order], false);
                $sort_order++;
            }
        }

        $course->save();

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index');
    }
}