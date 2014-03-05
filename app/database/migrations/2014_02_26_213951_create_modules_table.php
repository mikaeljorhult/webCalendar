<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'modules', function( Blueprint $table ) {
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			
			$table->string( 'name', 75 );
			$table->string( 'short_name', 10 );
			$table->string( 'calendar' );
			$table->date( 'start_date' );
			$table->date( 'end_date' );
			
			$table->timestamps();
			
			$table->index( 'name' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'modules' );
	}

}
