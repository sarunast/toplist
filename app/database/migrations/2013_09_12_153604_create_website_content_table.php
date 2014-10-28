<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsiteContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_contents', function($table)
        {
            $table->increments('id');
            $table->integer('website_page_id')->unsigned();
            $table->integer('website_id')->unsigned();
            $table->string('title');
            $table->text('content');
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
        Schema::drop('website_contents');
    }
}