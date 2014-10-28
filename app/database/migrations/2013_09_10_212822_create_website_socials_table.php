<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsiteSocialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('website_socials', function($table)
        {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->string('facebook');
            $table->string('gplus');
            $table->string('twitter');
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
        Schema::drop('website_socials');
    }
}