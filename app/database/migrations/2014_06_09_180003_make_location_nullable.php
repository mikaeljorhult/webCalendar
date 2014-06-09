<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLocationNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement( 'ALTER TABLE lessons CHANGE COLUMN location location VARCHAR( 75 );' );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement( 'ALTER TABLE lessons CHANGE COLUMN location location VARCHAR( 50 ) NOT NULL;' );
	}
}