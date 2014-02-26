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
 * Update courses.
 */
Route::get( 'update', array( 'as' => 'update', 'uses' => 'AppController@update', 'before' => 'auth' ) );
Route::get( 'update/{id}', array( 'as' => 'update.course', 'uses' => 'AppController@update', 'before' => 'auth' ) );

/*
 * Administration Panel.
 */
Route::group( array( 'prefix' => 'admin' ), function() {
	Route::get( '/', array( 'as' => 'admin', 'uses' => 'AppController@admin' ) );
	Route::resource( 'course', 'CourseController' );
	Route::resource( 'module', 'ModuleController' );
	Route::resource( 'lesson', 'LessonController' );
	Route::resource( 'user', 'UserController' );
} );

/*
 * Display course schedule.
 */
Route::get( 'schedule/{code}', array( 'uses' => 'CourseController@display' ) );