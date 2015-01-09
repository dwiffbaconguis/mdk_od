<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lastname', 20);
		    $table->string('firstname', 20);
		    $table->string('username', 20);
		    $table->string('password', 64);
		    $table->string('user_level',20);
		    $table->rememberToken();
		    $table->timestamps();
		});

		Schema::create('clients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lastname', 20);
		    $table->string('firstname', 20);
		    $table->integer('employee_id')->unsigned(); //display who handles the client
		    $table->foreign('employee_id')->references('id')->on('employees')
		    	->onDelete('restrict')
		    	->onUpdate('cascade');
		    $table->rememberToken();
		    $table->timestamps();
		});

		Schema::create('records', function(Blueprint $table){
			$table->increments('id');
			$table->date('date');
			$table->string('remarks', 128);
			$table->date('due_date');
			$table->string('notes', 128);
			$table->double('payments', 9, 2);
			$table->double('balance', 9, 2);
			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients')
		    	->onDelete('restrict')
		    	->onUpdate('cascade');
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employees')
		    	->onDelete('restrict')
		    	->onUpdate('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('records');
		Schema::drop('clients');
		Schema::drop('employees');
	}

}
