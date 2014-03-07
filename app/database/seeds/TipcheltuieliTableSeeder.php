<?php

class TipcheltuieliTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tipcheltuieli')->truncate();

		$tipcheltuieli = array(
                    array('denumire' => 'Apa'),
                    array('denumire' => 'Energie electrica'),
                    array('denumire' => 'RER'),
                    array('denumire' => 'Cheltuieli comune'),
                    array('denumire' => 'Cheltuieli specifice'),
                    array('denumire' => 'Taxa elsaco'),
		);
	
		// Uncomment the below to run the seeder
		DB::table('tipcheltuieli')->insert($tipcheltuieli);
	}

}
