<?php

// database/factories/SceanceFactory.php
// database/factories/SceanceFactory.php
namespace Database\Factories;

use App\Models\Sceance;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class SceanceFactory extends Factory
{
	protected $model = Sceance::class;

	public function definition()
	{
		return [
			'uid' => $this->faker->uuid,
			'room_uid' => Room::factory(),
			'movie' => $this->faker->numberBetween(1, 100), // Utilise des IDs de films entre 1 et 100
			'date' => $this->faker->dateTimeBetween('+0 days', '+1 year'),
		];
	}
}
