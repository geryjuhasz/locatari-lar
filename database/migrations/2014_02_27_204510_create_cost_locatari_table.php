<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCostLocatariTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cost_locatari', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('locatari_id');
			$table->decimal('costuri_persoana');
			$table->decimal('apa_rece');
			$table->decimal('dif_apa_rece');
			$table->decimal('apa_calda');
			$table->decimal('dif_apa_calda');
			$table->decimal('costuri_comune');
			$table->decimal('taxa_elsaco')->nullable();
			$table->decimal('caldura')->nullable();
			$table->decimal('fond_rulment')->nullable();
			$table->decimal('total');
			$table->date('luna');
			$table->boolean('platit');
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
		Schema::drop('cost_locatari');
	}

}
