<?php

use Faker\Factory as Faker;

class ModulesTableSeeder extends Seeder {
	public function run() {
		$faker = Faker::create();
		
		foreach ( range( 1, 30 ) as $index ) {
			Module::create( [
				'name' => trim( $faker->sentence( rand( 1, 3 ) ), ' .' ),
				'start_date' => $faker->dateTimeBetween( '-1 month', '+1 month' )->format( 'Y-m-d' ),
				'end_date' => $faker->dateTimeBetween( '-1 month', '+1 month' )->format( 'Y-m-d' ),
				'calendar' => 'http://google.se'
			] );
		}
	}
}