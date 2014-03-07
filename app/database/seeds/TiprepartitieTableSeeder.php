<?php

class TiprepartitieTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tiprepartitie')->truncate();

		$tiprepartitie = array(
                    array('denumire' => 'Asociatie'),
                    array('denumire' => 'Bloc'),
                    array('denumire' => 'Scara'),
                    array('denumire' => 'Apartament'),
		);

                // Uncomment the below to run the seeder
		DB::table('tiprepartitie')->insert($tiprepartitie);
	}

}
