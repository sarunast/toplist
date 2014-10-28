<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username', 64)->unique();
            $table->string('password', 100);
			$table->string('confirmation_code', 32)->nullable();
			$table->boolean('confirmed')->default(false);
            $table->smallInteger('role_id')->default(1);
            $table->boolean('subscription');
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
        Schema::drop('users');
    }

}