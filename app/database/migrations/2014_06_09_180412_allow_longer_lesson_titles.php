<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowLongerLessonTitles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement( 'ALTER TABLE lessons CHANGE COLUMN title title VARCHAR( 255 );' );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement( 'ALTER TABLE lessons CHANGE COLUMN title title VARCHAR( 75 );' );
	}
}