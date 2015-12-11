<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Home.
 */
Route::get('/', array('as' => 'home', 'uses' => 'AppController@index'));

/*
 * Log in and out.
 */
// Authentication routes...
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

/*
 * Administration Panel.
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'admin', 'uses' => 'AppController@admin']);

    /*
     * Resources.
     */
    Route::resource('courses', 'CoursesController');
    Route::resource('modules', 'ModulesController');
    Route::resource('lessons', 'LessonsController');
    Route::resource('users', 'UsersController');
});

/*
 * Display course schedule.
 */
Route::get('schedule/{code}', ['uses' => 'CoursesController@display']);