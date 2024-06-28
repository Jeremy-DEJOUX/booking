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
			'name' => 'required|string|max:128',
			'seats' => 'required|integer|min:1',
			'createdAt' => 'nullable|date',
			'updatedAt' => 'nullable|date',
		]);
		$room = new Room();
		$room->uid = Str::uuid()->toString();
		$room->cinema_uid = $cinemaUid;
		$room->name = $request->name;
		$room->seats = $request->seats;
		$room->created_at = $request->createdAt ?? now();
		$room->updated_at = $request->updatedAt ?? now();
		$room->save();
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

		return response()->json('Room deleted', 200);
	}
}
