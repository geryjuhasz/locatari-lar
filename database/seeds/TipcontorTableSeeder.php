<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TipcontorTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tipcontor')->truncate();

		$tipcontor = array(
                    array('denumire' => 'Bucatarie Apa Rece'),
                    array('denumire' => 'Bucatarie Apa Calda'),
                    array('denumire' => 'Baie1 Apa Rece'),
                    array('denumire' => 'Baie1 Apa Calda'),
                    array('denumire' => 'Baie2 Apa Rece'),
                    array('denumire' => 'Baie2 Apa Calda'),
                    array('denumire' => 'Bucatarie Calorifer'),
                    array('denumire' => 'Baie1 Calorifer'),
                    array('denumire' => 'Baie2 Calorifer'),
                    array('denumire' => 'Camera1 Calorifer'),
                    array('denumire' => 'Camera2 Calorifer'),
                    array('denumire' => 'Camera3 Calorifer'),
                    array('denumire' => 'Camera4 Calorifer'),
		);
		// Uncomment the below to run the seeder
		DB::table('tipcontor')->insert($tipcontor);
	}

}
