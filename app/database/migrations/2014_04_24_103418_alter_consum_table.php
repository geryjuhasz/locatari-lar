<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterConsumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::table('consum', function($table)
                {
                    $table->dropColumn('index_vechi');
                    $table->dropColumn('index_nou');

                });
                Schema::table('consum', function($table)
                {
                    $table->decimal('index_vechi_rece');
                    $table->decimal('index_nou_rece');
                    $table->decimal('index_vechi_calda');
                    $table->decimal('index_nou_calda');
                });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('consum');
	}

}
