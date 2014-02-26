<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'users', function( Blueprint $table ) {
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			
			$table->string( 'username', 128 );
			$table->string( 'password', 64 );
			$table->string( 'email', 254 );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'users' );
	}

}