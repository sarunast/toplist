<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsiteNavAppsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_nav_apps', function($table)
        {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('website_app_id')->unsigned();
            $table->smallInteger('position')->unsigned();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('website_nav_apps');
    }
}