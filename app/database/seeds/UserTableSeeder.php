<?php

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table( 'users' )->insert( array(
			'username' => 'mjr',
			'password' => Hash::make( getenv( 'DEFAULT_PASSWORD' ) ),
			'email' => 'mjr@du.se'
		) );
	}
}