<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('AsociatieTableSeeder');
		$this->call('BlocTableSeeder');
                $this->call('ScaraTableSeeder');
		$this->call('TipcalculrepartitieTableSeeder');
		$this->call('TipcheltuieliTableSeeder');
		$this->call('TipconsumTableSeeder');
		$this->call('TipincapereTableSeeder');
		$this->call('TiprepartitieTableSeeder');
		$this->call('AsociatiesTableSeeder');
	}

}