	<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use EntradasEventos\Entities\Eventos;

class EventosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			 $fullName = $faker->name;
			  Eventos::create([
               	'evento_nombre' => $fullName,
                'slug' => \Str::slug($fullName)
			]);
		}
	}

}
