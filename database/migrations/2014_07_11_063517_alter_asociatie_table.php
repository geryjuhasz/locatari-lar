<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterAsociatieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('asociatie', function($table)
                {
                    $table->dropColumn('administrator');
                });
                Schema::table('asociatie', function($table)
                {
                    $table->integer('admin_id');
                });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('asociatie');
	}

}
