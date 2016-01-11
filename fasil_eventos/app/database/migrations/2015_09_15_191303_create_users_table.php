<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('user_nombre');
			$table->string('user_telefono')->nullable();
			$table->string('user_ci')->nullable();
			$table->string('email')->nullable();
			$table->string('user_fechaNac')->nullable();
			$table->string('password');
			$table->enum('user_tipo', ['admin','suscriptor']);
			$table->string('remember_token')->nullable();


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
		Schema::drop('users');
	}

}
