<?php

use Illuminate\Database\Migrations\Migration;

class CreateFrequentStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('frequent_stats', function($table)
        {
            $table->integer('server_id')->unsigned;
            $table->boolean('online');
            $table->date('created_at');
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
        Schema::drop('frequent_stats');
    }

}