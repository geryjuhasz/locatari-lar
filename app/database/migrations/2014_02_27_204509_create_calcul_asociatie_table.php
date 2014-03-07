<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalculAsociatieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calcul_asociatie', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asociatie_id');
			$table->integer('tipcheltuieli_id');
			$table->integer('tipcalculrepartitie_id');
			$table->integer('tiprepartitie_id');
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
		Schema::drop('calcul_asociatie');
	}

}
