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

		$this->call('UserTableSeeder');
		
		$this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
			'username'  => 'guest',
			'password'  => '$2a$08$l17kUazWvGoskTtW6szQlufpu6wku0xL0Bz74Ba/V4uxJLLZTB88G',
		));
	}

}