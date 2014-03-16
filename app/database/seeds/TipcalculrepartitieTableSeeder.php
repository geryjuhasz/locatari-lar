<?php

class TipcalculrepartitieTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tipcalculrepartitie')->truncate();

		$tipcalculrepartitie = array(
                       array('denumire' => 'Numar persoane'),
                       array('denumire' => 'Suprafata mp'),
                       array('denumire' => 'Apartament'),
                       array('denumire' => 'Scara'),
                       array('denumire' => 'Consum mc'),
		);
	
		// Uncomment the below to run the seeder
		DB::table('tipcalculrepartitie')->insert($tipcalculrepartitie);
	}

}
