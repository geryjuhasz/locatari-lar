<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScara extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            //DB::query('alter table scara modify total_apartamente integer');
            Schema::table('scara', function($table)
                {
                    $table->dropColumn('total_apartamente');
                });
            Schema::table('scara', function($table)
                {
                    $table->integer('total_apartamente');
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
