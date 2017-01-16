<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCheltuieli extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cheltuieli', function($table)
            {
            	$table->integer('furnizor_id')->nullable();
            	$table->string('numar_doc', 100)->nullable();
            	$table->date('data_doc')->nullable();
            	$table->date('data_scadenta')->nullable();
            	$table->integer('tipdocument_id')->nullable();
                
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
