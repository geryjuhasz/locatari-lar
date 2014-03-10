<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
            DB::table('users')->truncate();
            DB::table('users')->insert(
                    array(
                            'username' => 'admin',
                            'name'     => 'Ion',
                            'type'     => 1,
                            'email'    => 'admin@asociatie.ro',
                            'password' => Hash::make('admin'),
                    )
            );
            
            $this->command->info('Users table seeded! Your login is: admin, pass: admin');
        }
}

