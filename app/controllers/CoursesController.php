<?php

class CoursesController extends \BaseController {
	protected $layout = '_layouts.default';
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$courses = Course::all();
		
		$this->layout->content = View::make( 'courses.index' )
			->with( 'courses', $courses );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$this->layout->content = View::make( 'courses.create' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$course = new Course;
		
		$course->name = Input::get( 'name' );
		$course->code = Input::get( 'code' );
		$course->start_date = Input::get( 'start_date' );
		$course->end_date = Input::get( 'end_date' );
		$course->created_at = new DateTime;
		
		if ( $course->validate() ) {
			$course->save();
		} else {
			return Redirect::back()->withInput();
		}
		
		return Redirect::route( 'admin.courses.index' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  string  $code
	 * @return Response
	 */
	public function display( $code ) {
		$course = Course::where( 'code', '=', $code )->get();
		
		if ( $course ) {
			$course = $course[ 0 ];
			$modules = $course->modules()->with( 'lessons' )->get();
			
			$module_id = $course->modules()->lists( 'module_id' );
			$lessons = Lesson::whereIn( 'module_id', $module_id )->orderBy( 'start_time', 'ASC' )->orderBy( 'title', 'ASC' )->get();
			
			if ( Request::ajax() ) {
				return $course;
			} else {
				$this->layout->content = View::make( 'courses.schedule' )
					->with( 'course', $course )
					->with( 'modules', $modules )
					->with( 'lessons', $lessons );
			}
		} else {
			return Redirect::route( 'home' );
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id ) {
		$course = Course::find( $id );
		
		if ( $course ) {
			$modules = $course->modules()->with( 'lessons' )->get();
			
			$module_id = $course->modules()->lists( 'id' );
			$lessons = Lesson::whereIn( 'module_id', $module_id )->orderBy( 'start_time', 'ASC' )->orderBy( 'title', 'ASC' )->get();
			
			if ( Request::ajax() ) {
				return $course;
			} else {
				$this->layout->content = View::make( 'courses.view' )
					->with( 'course', $course )
					->with( 'modules', $modules )
					->with( 'lessons', $lessons );
			}
		} else {
			return Redirect::route( 'home' );
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $id ) {
		$course = Course::find( $id );
		
		$this->layout->content = View::make( 'courses.edit' )
			->with( 'course', $course );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id ) {
		$course = Course::find( $id );
		
		$course->name = Input::get( 'name' );
		$course->code = Input::get( 'code' );
		$course->start_date = Input::get( 'start_date' );
		$course->end_date = Input::get( 'end_date' );
		
		if ( $course->validate() ) {
			$course->save();
		} else {
			return Redirect::back()->withInput();
		}
		
		return Redirect::route( 'admin.courses.index' );
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $id ) {
		$course = Course::find( $id );
		$course->delete();
		
		return Redirect::route( 'admin.courses.index' );
	}
}