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
		foreach ( [ 'users', 'courses', 'modules', 'course_module', 'lessons' ] as $table ) {
			DB::table( $table )->delete();
		}
		
		// Populate tables.
		$this->call( 'UsersTableSeeder' );
		$this->call( 'CoursesTableSeeder' );
		$this->call( 'ModulesTableSeeder' );
		$this->call( 'CourseModuleTableSeeder' );
		$this->call( 'LessonsTableSeeder' );
	}

}