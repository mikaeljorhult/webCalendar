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
}
