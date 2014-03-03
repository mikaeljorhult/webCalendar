<?php

class CourseModuleTableSeeder extends Seeder {
	public function run() {
		DB::table( 'course_module' )->insert( array(
			'course_id' => 1,
			'module_id' => 1,
			'sort_order' => 1
		) );
	}
}