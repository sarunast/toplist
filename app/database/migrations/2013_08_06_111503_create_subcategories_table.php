<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('subcategories', function($table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned;
            $table->string('name');
            $table->string('path');
            $table->string('alias');
            $table->boolean('tcp')->default(1);
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
        Schema::drop('subcategories');
    }

}