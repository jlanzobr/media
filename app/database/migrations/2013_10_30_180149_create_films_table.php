<?php

use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('films', function($table){
			$table->increments('id');
			$table->string('name');
			$table->integer('year');
			$table->decimal('rating', 3, 1);
			$table->text('description');
			$table->string('imdb_id')->nullable();
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
		Schema::drop('films');
	}

}