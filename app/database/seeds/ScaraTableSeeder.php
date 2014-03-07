<?php

class ScaraTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('scara')->truncate();

		$scara = array(
                        'bloc_id' => '1', 
                        'denumire' => 'Scara D',
                        'total_apartamente' => '20',
                        'total_mp' => 1000
		);
                
		// Uncomment the below to run the seeder
		DB::table('scara')->insert($scara);
	}

}
