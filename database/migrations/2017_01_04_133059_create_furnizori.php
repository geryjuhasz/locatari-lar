<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurnizori extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('furnizori', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nume', 100);
			$table->string('codfiscal', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('telefon', 100)->nullable();
			$table->string('contbancar', 100)->nullable();
			$table->string('banca', 100)->nullable();
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
		//
	}

}
