<?php

use Illuminate\Database\Migrations\Migration;

class CreatePageApps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_apps', function($table)
        {

            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            $table->boolean('header');
            $table->boolean('nav');
            $table->boolean('page');
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
        Schema::drop('website_apps');
    }
}
