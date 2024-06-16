<?php

// database/seeders/RoomSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Cinema;

class RoomSeeder extends Seeder
{
	public function run()
	{
		// Assurez-vous que des cinémas existent avant de créer des salles
		Cinema::all()->each(function ($cinema) {
			Room::factory()->count(4)->create(['cinema_uid' => $cinema->uid]);
		});
	}
}
