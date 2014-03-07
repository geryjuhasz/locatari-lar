<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScaraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scara', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('bloc_id');
			$table->string('denumire', 250);
			$table->string('total_apartamente', 250);
			$table->decimal('total_mp');
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
		Schema::drop('scara');
	}

}
