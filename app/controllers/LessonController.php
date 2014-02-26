<?php

class LessonController extends \BaseController {
	protected $layout = '_layouts.default';
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$lessons = Lesson::all();
		
		$this->layout->content = View::make( 'lesson.index' )
			->with( 'lessons', $lessons );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$this->layout->content = View::make( 'lesson.create' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$module = array(
			'module_id' => Input::get( 'module_id' ),
			'title' => Input::get( 'title' ),
			'location' => Input::get( 'name' ),
			'description' => Input::get( 'description' ),
			'start_time' => Input::get( 'start_time' ),
			'end_time' => Input::get( 'end_time' )
		);
		
		Module::insert( $module );
		
		return Redirect::route( 'module.index' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id ) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $id ) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id ) {
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $id ) {
		//
	}
	
}