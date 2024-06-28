<?php

namespace Database\Factories;

use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

class CinemaFactory extends Factory
{
	protected $model = Cinema::class;

	public function definition()
	{
		return [
			'uid' => $this->faker->uuid,
			'name' => $this->faker->company,
		];
	}
}
