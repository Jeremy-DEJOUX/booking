<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CinemaResource;

class CinemaController extends Controller
{
	public function index()
	{
		return CinemaResource::collection(Cinema::get());
	}

	public function show($id)
	{
		$cinema = Cinema::find($id);
		if (!$cinema) {
			return response()->json(['message' => 'Cinema not found'], 404);
		}

		return response()->json($cinema, 200);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:128'
		]);

		$cinema = new Cinema;
		$cinema->name = $request->name;
		$cinema->save();

		return response()->json($cinema, 201);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:128'
		]);

		$cinema = Cinema::find($id);

		if (!$cinema) {
			return response()->json(['message' => 'Cinema not found', 404]);
		}

		$cinema->name = $request->name;
		$cinema->save();

		return response()->json($cinema, 200);
	}

	public function remove($id)
	{
		$cinema = Cinema::find($id);

		if (!$cinema) {
			return response()->json(['message' => 'Cinema not found'], 404);
		}

		$cinema->delete();

		return response()->json(['message' => 'Cinema deleted successfully']);
	}
}
