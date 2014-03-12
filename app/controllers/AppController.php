<?php

class AppController extends BaseController {
	protected $layout = '_layouts.default';
	
	public function index() {
		$courses = Course::active()->get();
		
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
			$modules = Module::active()->get();
		}
		
		if ( count( $modules ) > 0 ) {
			foreach ( $modules as $module ) {
				$module->retrieve();
			}
		} else {
			// No active courses.
		}
		
		$this->layout->content = View::make( 'update' );
	}
}