<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->integer('module_id')->unsigned();

            $table->string('title', 255);
            $table->string('location', 75)->nullable();
            $table->string('description')->nullable();

            $table->timestamp('start_time')->default('0000-00-00 00:00:00')->index();
            $table->timestamp('end_time')->default('0000-00-00 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }

}
