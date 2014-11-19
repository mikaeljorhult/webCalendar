<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UseApiV3CalendarIdFormat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		// Fetch all modules.
		$modules = Module::all();
		
		// Go through each module.
		foreach ( $modules as $module ) {
			$output = array();
			
			// Find the Calendar ID.
			preg_match("/\/(\w+%40[\w|\.]+)\//i", str_replace( '@', '%40', $module->calendar ), $output );
			
			// If Calendar ID was found replace URL with ID and save to database.
			if ( count( $output ) > 1 ) {
				$module->calendar = $output[ 1 ];
				$module->save();
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		// It can't be undone.
	}
}
