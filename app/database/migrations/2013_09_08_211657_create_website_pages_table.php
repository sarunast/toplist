<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsitePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_pages', function($table)
        {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->string('name');
            $table->string('path');
            $table->string('website_app');
            $table->boolean('comments');
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
        Schema::drop('website_pages');
    }
}