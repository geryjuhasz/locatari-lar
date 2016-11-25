<?php

class TipincapereTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tipincapere')->truncate();

		$tipincapere = array(
                    array('denumire' => 'Bucatarie'),
                    array('denumire' => 'Baie1'),
                    array('denumire' => 'Baie2'),
                    array('denumire' => 'Camera1'),
                    array('denumire' => 'Camera2'),
                    array('denumire' => 'Camera3'),
                    array('denumire' => 'Camera4'),
		);
		// Uncomment the below to run the seeder
		DB::table('tipincapere')->insert($tipincapere);
	}

}
