<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAsociatieConsumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('asociatie_consum', function($table)
        {
            $table->integer('tipcontor_id');
        });
        Schema::table('asociatie_consum', function($table)
        {
            $table->dropColumn('tipincapere_id');
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
