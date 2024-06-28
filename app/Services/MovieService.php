<?php

// app/Services/MovieService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;


class MovieService
{

	public function getMovie($uid)
	{
		try {
			$response = Http::get("http://host.docker.internal:8000/movies/{$uid}");
			if ($response->successful()) {
				return $response->json();
			} else {
				return ['error' => 'Movie not found'];
			}
		} catch (\Exception $e) {
			return ['error' => 'Service not available'];
		}
	}
}
