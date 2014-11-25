<?php

class UsersController extends BaseController {
	protected $layout = '_layouts.default';
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$users = User::all();
		
		$this->layout->content = View::make( 'users.index' )
			->with( 'users', $users );
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login() {
		$userdata = array(
			'username' => Input::get( 'username' ),
			'password' => Input::get( 'password' )
		);
		
		if ( Auth::attempt( $userdata ) ) {
			return Redirect::route( 'home' );
		} else {
			return Redirect::route( 'home' );
		}
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showLogin() {
		$this->layout->content = View::make( 'login' );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$this->layout->content = View::make( 'users.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$user = new User;
		
		$user->username = Input::get( 'username' );
		$user->password = Input::get( 'password' );
		$user->email = Input::get( 'email' );
		
		if ( $user->validate() ) {
			$user->save();
			return Redirect::route( 'admin.users.index' );
		}
		
		return Redirect::back()
			->withInput( Input::except( 'password' ) )
			->withErrors( $user->errors );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id ) {
		$user = User::find( $id );
		
		$this->layout->content = View::make( 'users.show' )
			->with( 'user', $user );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $id ) {
		$user = User::find( $id );
		
		$this->layout->content = View::make( 'users.edit' )
			->with( 'user', $user );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id ) {
		$user = User::find( $id );
		
		$user->username = Input::get( 'username' );
		$user->email = Input::get( 'email' );
		
		if ( Input::has( 'password' ) ) {
			$user->password = Input::get( 'password' );
		}
		
		if ( $user->validate() ) {
			$user->save();
			return Redirect::route( 'admin.users.index' );
		}
		
		return Redirect::back()
			->withInput( Input::except( 'password' ) )
			->withErrors( $user->errors );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $id ) {
		$user = User::find( $id );
		
		if ( $id != Auth::user()->id ) {
			$user->delete();
		}
		
		return Redirect::route( 'admin.users.index' );
	}
}