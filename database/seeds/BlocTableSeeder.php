<?php

class BlocTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('bloc')->truncate();

		$bloc = array(
                        'asociatie_id' => '1', 
                        'denumire' => 'Bloc F3' 
		);

		// Uncomment the below to run the seeder
		DB::table('bloc')->insert($bloc);
	}

}
