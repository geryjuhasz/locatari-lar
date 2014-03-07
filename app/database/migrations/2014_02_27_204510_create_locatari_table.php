<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocatariTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locatari', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('scara_id');
			$table->string('nume', 100);
			$table->decimal('suprafata_mp');
			$table->boolean('nr_apartament');
			$table->boolean('nr_persoane');
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
		Schema::drop('locatari');
	}

}
