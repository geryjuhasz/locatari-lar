<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		//$this->call('UserTableSeeder');
		//$this->call('AsociatieTableSeeder');
		//$this->call('BlocTableSeeder');
        //$this->call('ScaraTableSeeder');
		//$this->call('TipcalculrepartitieTableSeeder');
		//$this->call('TipcheltuieliTableSeeder');
		//$this->call('TipconsumTableSeeder');
		//$this->call('TipincapereTableSeeder');
		//$this->call('TiprepartitieTableSeeder');
		//$this->call('AsociatiesTableSeeder');
		//$this->call('LocatarisTableSeeder');
		//$this->call('Calcul_asociatiesTableSeeder');
		//$this->call('ConsumsTableSeeder');
		//$this->call('CeltuielisTableSeeder');
		//$this->call('CheltuielisTableSeeder');
		//$this->call('Cost_locatarisTableSeeder');
        //$this->call('UserTableSeeder');
		//$this->call('Asociatie_consumsTableSeeder');
		//$this->call('TipcontorTableSeeder');
		$this->call('TipdocumentTableSeeder');
	}

}