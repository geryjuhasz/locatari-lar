<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConsumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('consum', function($table)
        {
            $table->integer('tipcontor_id');
            $table->decimal('index_vechi');
            $table->decimal('index_nou');

        });
        Schema::table('consum', function($table)
        {
            $table->dropColumn('tipincapere_id');
            $table->dropColumn('index_vechi_rece');
            $table->dropColumn('index_nou_rece');
            $table->dropColumn('index_vechi_calda');
            $table->dropColumn('index_nou_calda');
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
