<?php

class CoursesTableSeeder extends Seeder {
	public function run() {
		DB::table( 'courses' )->insert( array(
			'name' => 'Musikskapande',
			'code' => 'lp1046',
			'start_date' => '2014-02-01',
			'end_date' => '2014-12-01'
		) );
	}
}