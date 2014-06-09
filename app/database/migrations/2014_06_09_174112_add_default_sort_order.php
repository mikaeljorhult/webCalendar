<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDefaultSortOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement( 'ALTER TABLE course_module CHANGE COLUMN sort_order sort_order int( 10 ) UNSIGNED NOT NULL DEFAULT "1";' );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement( 'ALTER TABLE course_module CHANGE COLUMN sort_order sort_order int( 10 ) UNSIGNED NOT NULL;' );
	}

}