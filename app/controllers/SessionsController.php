<?php

class SessionsController extends \BaseController {
	protected $layout = '_layouts.default';
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$this->layout->content = View::make( 'sessions.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$user = [
			'username' => Input::get( 'username' ),
			'password' => Input::get( 'password' ),
			'suspended' => 0
		];
		
		if ( Auth::attempt( $user, true ) ) {
			Auth::user()->logged_in_at = new DateTime;
			Auth::user()->save();
			
			return Redirect::intended( '/' );
		}
		
		return Redirect::route( 'home' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy() {
		Auth::logout();
		
		return Redirect::route( 'home' );
	}
}