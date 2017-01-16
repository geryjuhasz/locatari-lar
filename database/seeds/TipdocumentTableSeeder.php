<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
	
class TipdocumentTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tipdocument')->truncate();

		$tipdocument = array(
                    array('denumire' => 'Factura'),
                    array('denumire' => 'Bon fiscal'),
                    array('denumire' => 'Nota contabila'),
		);

                // Uncomment the below to run the seeder
		DB::table('tipdocument')->insert($tipdocument);
	}

}
