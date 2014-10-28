<?php

use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('servers', function($table)
        {
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned;
            $table->integer('user_id')->unsigned;
            $table->string('title');
            $table->string('url');
            $table->string('image');
            $table->string('description');
            $table->string('ip');
            $table->string('slug');
            $table->smallInteger('port')->unsigned;
            $table->smallInteger('rank')->unsigned;
            $table->integer('votes')->unsigned;
            $table->integer('day_votes')->unsigned;
            $table->integer('clicks')->unsigned;
            $table->integer('day_clicks')->unsigned;
            $table->boolean('online');
            $table->timestamps();
            /**
             *add in and out*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }

}