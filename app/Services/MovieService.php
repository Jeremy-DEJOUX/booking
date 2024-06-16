<?php

// app/Services/MovieService.php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MovieService
{
	protected $client;
	protected $baseUri;

	public function __construct()
	{
		$this->client = new Client();
		$this->baseUri = env('MOVIE_SERVICE_BASE_URI', 'http://localhost:8080');
	}

	public function getMovie($uid)
	{
		try {
			$response = $this->client->request('GET', "{$this->baseUri}/movies/{$uid}");
			return json_decode($response->getBody()->getContents(), true);
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				return json_decode($e->getResponse()->getBody()->getContents(), true);
			}
			return ['error' => 'Service not available'];
		}
	}
}
