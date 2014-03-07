<?php

class AsociatieTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('asociatie')->truncate();

		$asociatie = array(
                        'denumire' => 'Asociatia Selimbarului', 
                        'administrator' => 'Joska' 
		);

		// Uncomment the below to run the seeder
		DB::table('asociatie')->insert($asociatie);
	}

}
