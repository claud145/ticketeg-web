<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('evento_nombre');
			$table->string('evento_genero')->nullable();
			$table->string('evento_fecha')->nullable();
			$table->string('evento_descripcion',300)->nullable();
			$table->string('evento_img')->nullable();
			$table->string('evento_youtube')->nullable();
			$table->enum('evento_tipo',['concierto','pelicula','partido'])->nullable();

			$table->string('CP_lugar')->nullable();
			$table->string('CP_hora')->nullable();

			$table->string('slug')->nullable();
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
		Schema::drop('eventos');
	}

}
