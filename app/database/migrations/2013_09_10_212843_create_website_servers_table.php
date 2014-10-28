<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsiteServersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_servers', function($table)
        {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->string('server_id');
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
        Schema::drop('website_servers');
    }
}