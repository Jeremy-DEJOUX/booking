<?php

// database/seeders/CinemaSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;

class CinemaSeeder extends Seeder
{
	public function run()
	{
		Cinema::factory()->count(5)->create();
	}
}
