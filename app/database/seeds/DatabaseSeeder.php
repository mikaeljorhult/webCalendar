<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();
		
		// Empty all tables.
		DB::table( 'users' )->delete();
		
		// Populate tables.
		$this->call( 'UsersTableSeeder' );
		$this->call( 'CoursesTableSeeder' );
		$this->call( 'ModulesTableSeeder' );
		$this->call( 'CourseModuleTableSeeder' );
	}

}