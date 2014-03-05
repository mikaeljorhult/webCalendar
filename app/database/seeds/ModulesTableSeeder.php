<?php

class ModulesTableSeeder extends Seeder {
	public function run() {
		DB::table( 'modules' )->insert( array(
			'name' => 'Musikskapande',
			'short_name' => 'module-1',
			'start_date' => '2014-02-01',
			'end_date' => '2014-12-01',
			'calendar' => 'https://www.google.com/calendar/feeds/71o5b1bl27os2c3bspqmk0rans%40group.calendar.google.com/private-c6747fc3e8aa6cfea85c144e5364a2a1/basic'
		) );
	}
}