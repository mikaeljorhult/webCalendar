<?php

class CoursesTableSeeder extends Seeder {
	public function run() {
		DB::table( 'courses' )->insert( array(
			'name' => 'Musikskapande',
			'code' => 'lp1046'
		) );
	}
}