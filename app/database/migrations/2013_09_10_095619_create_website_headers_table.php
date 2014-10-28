<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsiteHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_headers', function($table)
        {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('size')->default(110);
            $table->string('title');
            $table->string('slogan');
            $table->string('image');
            $table->string('panel');
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
        Schema::drop('website_headers');
    }
}