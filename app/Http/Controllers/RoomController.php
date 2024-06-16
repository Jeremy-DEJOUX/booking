<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
	public function index($cinemaUid)
	{
		$rooms = Room::where('cinema_uid', $cinemaUid)->get();
		return response()->json($rooms, 200);
	}

	public function show($cinemaUid, $uid)
	{
		$room = Room::where('cinema_uid', $cinemaUid)->where('uid', $uid)->firstOrFail();
		return response()->json($room, 200);
	}

	public function store(Request $request, $cinemaUid)
	{
		$request->validate([
			'uid' => 'required|uuid',
			'name' => 'required|string|max:128',
			'seats' => 'required|integer|min:1',
		]);

		$room = Room::create([
			'uid' => $request->uid,
			'cinema_uid' => $cinemaUid,
			'name' => $request->name,
			'seats' => $request->seats,
		]);

		return response()->json($room, 201);
	}

	public function update(Request $request, $cinemaUid, $uid)
	{
		$room = Room::where('cinema_uid', $cinemaUid)->where('uid', $uid)->firstOrFail();

		$request->validate([
			'name' => 'string|max:128',
			'seats' => 'integer|min:1',
		]);

		$room->update($request->only(['name', 'seats']));

		return response()->json($room, 200);
	}

	public function destroy($cinemaUid, $uid)
	{
		$room = Room::where('cinema_uid', $cinemaUid)->where('uid', $uid)->firstOrFail();
		$room->delete();

		return response()->noContent();
	}
}
