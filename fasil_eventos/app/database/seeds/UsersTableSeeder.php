<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use EntradasEventos\Entities\User;
class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		foreach(range(1, 5) as $index)
		{
            User::create([
               'user_nombre' => $faker->name,
               'email'       => $faker->email,
               'password'    =>  \Hash::make(123456),
               'user_tipo'     => 'suscriptor'
            ]);
		}
	}

}
