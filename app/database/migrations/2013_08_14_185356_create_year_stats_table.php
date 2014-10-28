<?php

use Illuminate\Database\Migrations\Migration;

class CreateYearStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('year_stats', function($table)
        {
            $table->integer('server_id')->unsigned;
            $table->smallInteger('up_percent');
            $table->integer('votes')->unsigned;
            $table->integer('clicks')->unsigned;
            $table->smallInteger('rank')->unsigned;
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
        Schema::drop('year_stats');
    }

}