<?php

/*
 * Home.
 */
Route::get( '/', array( 'as' => 'home', 'uses' => 'AppController@index' ) );

/*
 * Log in and out.
 */
Route::get( 'login', [ 'as' => 'login', 'uses' => 'SessionsController@create' ] );
Route::get( 'logout', [ 'as' => 'logout', 'uses' => 'SessionsController@destroy' ] );
Route::resource( 'sessions', 'SessionsController', [ 'only' => [ 'create', 'destroy', 'store' ] ] );

/*
 * Administration Panel.
 */
Route::group( array( 'prefix' => 'admin', 'before' => 'auth' ), function() {
	Route::get( '/', array( 'as' => 'admin', 'uses' => 'AppController@admin' ) );
	
	/*
	 * Resources.
	 */
	Route::resource( 'courses', 'CoursesController' );
	Route::resource( 'modules', 'ModulesController' );
	Route::resource( 'lessons', 'LessonsController' );
	Route::resource( 'users', 'UsersController' );
	
	/*
	 * Update courses.
	 */
	Route::get( 'update', array( 'as' => 'update', 'uses' => 'AppController@update' ) );
	Route::get( 'update/{id}', array( 'as' => 'update.course', 'uses' => 'AppController@update' ) );
} );

/*
 * Display course schedule.
 */
Route::get( 'schedule/{code}', array( 'uses' => 'CoursesController@display' ) );

/*
 * Form macros.
 */
Form::macro( 'courseCheckbox', function( $name, $selected = array() ) {
	$return = '';
	$courses = Course::orderBy( 'name' )->get();
	
	foreach ( $courses as $course ) {
		$return .= '<li><label>' .
			'<input type="checkbox" name="' . $name . '[]" value="' . $course->id . '"' . ( in_array( $course->id, $selected ) ? ' checked="checked"' : '' ) . ' /> ' .
			$course->name .
			'</label></li>';
	}
	
	return ( $return ? '<ul>' . $return . '</ul>' : '' );
} );