<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsiteNavigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_navigations', function($table)
        {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->smallInteger('position')->unsigned();
            $table->smallInteger('type')->unsigned();
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
        Schema::drop('website_navigations');
    }
}