<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCheltuieliTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cheltuieli', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asociatie_id');
			$table->integer('tipcheltuieli_id');
			$table->date('luna');
			$table->decimal('suma');
			$table->string('detalii', 250)->nullable();
			$table->integer('object_id')->nullable();
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
		Schema::drop('cheltuieli');
	}

}
