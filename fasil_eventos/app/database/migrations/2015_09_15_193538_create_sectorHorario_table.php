<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectorHorarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sectorHorarios', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('nombre_sector');
			$table->double('precio_sector');
 			$table->integer('evento');


			$table->timestamps();
			//$table->foreign('evento')->references('id')->on('eventos');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sectorHorario');
	}

}
