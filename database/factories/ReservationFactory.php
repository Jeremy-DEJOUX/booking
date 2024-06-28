<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Sceance;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
	protected $model = Reservation::class;

	public function definition()
	{
		return [
			'uid' => $this->faker->uuid,
			'sceance_uid' => Sceance::factory(),
			'rank' => $this->faker->numberBetween(1, 10),
			'status' => $this->faker->randomElement(['open', 'expired', 'confirmed']),
			'seats' => $this->faker->numberBetween(1, 10),
		];
	}
}
