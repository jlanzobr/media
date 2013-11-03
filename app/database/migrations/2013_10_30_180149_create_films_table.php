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
			$table->string('name')->nullable();
			$table->integer('year')->nullable();
			$table->string('extension')->nullable();
			$table->decimal('rating', 3, 1)->nullable();
			$table->text('description')->nullable();
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