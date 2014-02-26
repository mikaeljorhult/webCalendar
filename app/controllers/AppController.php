<?php

class AppController extends BaseController {
	protected $layout = '_layouts.default';
	
	public function index() {
		$today = new DateTime( 'today' );
		$courses = Course::where( 'start_date', '<=', $today )
			->where( 'end_date', '>=', $today )
			->get();
		
		$this->layout->content = View::make( 'home' )
			->with( 'courses', $courses );
	}
	
	public function admin() {
		$courses = Course::all();
		
		$this->layout->content = View::make( 'admin' )
			->with( 'courses', $courses );
	}
	
	public function update( $id = 'all' ) {
		if ( is_numeric( $id ) ) {
			$courses = Course::find( $id );
		} else {
			$today = new DateTime( 'today' );
			$courses = Course::where( 'start_date', '<=', $today )
				->where( 'end_date', '>=', $today )
				->with( 'modules' )
				->get();
		}
		
		if ( count( $courses ) > 0 ) {
			foreach( $courses as $course ) {
				foreach ( $course->modules as $module ) {
					$module->retrieve();
				}
			}
		} else {
			// Inga aktiva kurser.
		}
		
		$this->layout->content = View::make( 'update' );
	}
}