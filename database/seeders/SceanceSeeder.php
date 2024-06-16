<?php

// database/seeders/SceanceSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sceance;
use App\Models\Room;

class SceanceSeeder extends Seeder
{
	public function run()
	{
		// Assurez-vous que des salles existent avant de créer des séances
		Room::all()->each(function ($room) {
			Sceance::factory()->count(5)->create(['room_uid' => $room->uid]);
		});
	}
}
