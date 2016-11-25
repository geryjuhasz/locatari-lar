<?php

class TipconsumTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tipconsum')->truncate();

		$tipconsum = array(
                    array('denumire' => 'Apa'),
                    array('denumire' => 'Caldura'),
		);

                // Uncomment the below to run the seeder
		DB::table('tipconsum')->insert($tipconsum);
	}

}
