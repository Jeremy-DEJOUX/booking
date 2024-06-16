<?php

// database/factories/RoomFactory.php
namespace Database\Factories;

use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
	protected $model = Room::class;

	public function definition()
	{
		return [
			'uid' => $this->faker->uuid,
			'cinema_uid' => Cinema::factory(), // Générer un cinéma associé
			'name' => $this->faker->word,
			'seats' => $this->faker->numberBetween(50, 300),
		];
	}
}
