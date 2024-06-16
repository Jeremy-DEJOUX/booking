<?php

// database/seeders/ReservationSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Sceance;

class ReservationSeeder extends Seeder
{
	public function run()
	{
		// Assurez-vous que des séances existent avant de créer des réservations
		Sceance::all()->each(function ($sceance) {
			Reservation::factory()->count(10)->create(['sceance_uid' => $sceance->uid]);
		});
	}
}
