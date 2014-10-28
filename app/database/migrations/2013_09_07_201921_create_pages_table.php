<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('websites', function($table)
        {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('paypal_email');
            $table->string('email');
            $table->string('path')->unique();
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
        Schema::drop('websites');
    }
}
