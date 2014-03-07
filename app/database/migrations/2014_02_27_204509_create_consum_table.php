<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consum', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('locatari_id');
			$table->integer('tipincapere_id')->nullable();
			$table->decimal('index_vechi');
			$table->decimal('index_nou');
			$table->date('luna');
			$table->integer('tipconsum_id');
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
		Schema::drop('consum');
	}

}
