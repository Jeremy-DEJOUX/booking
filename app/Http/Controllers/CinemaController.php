<?php

// app/Http/Controllers/CinemaController.php
namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
	public function index()
	{
		return Cinema::all();
	}

	public function show($uid)
	{
		return Cinema::findOrFail($uid);
	}

	public function store(Request $request)
	{
		$request->validate([
			'uid' => 'required|uuid',
			'name' => 'required|string|max:128',
		]);

		return Cinema::create($request->all());
	}

	public function update(Request $request, $uid)
	{
		$cinema = Cinema::findOrFail($uid);
		$cinema->update($request->all());

		return $cinema;
	}

	public function destroy($uid)
	{
		$cinema = Cinema::findOrFail($uid);
		$cinema->delete();

		return response(null, 204);
	}
}
