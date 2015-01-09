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

		$this->call('EmployeeTableSeeder');
	}


}

class EmployeeTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('employees')->delete();
		Employee::create(array(
			'lastname'     => 'Baconguis',
			'firstname' => 'Dwiff',
			'username' => 'dwiff.baconguis',
			'password' => Hash::make('dwiff123'),
			'user_level' => 'Admin'
		));
	}

}
