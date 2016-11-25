<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsociatieConsumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asociatie_consum', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asociatie_id');
                        $table->integer('tipconsum_id');
                        $table->integer('tipincapere_id');
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
		Schema::drop('asociatie_consum');
	}

}
