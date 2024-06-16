<?php

namespace App\Http\Controllers;

use App\Models\Sceance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SceanceController extends Controller
{
	public function index($cinemaUid, $roomUid)
	{
		$sceances = Sceance::where('room_uid', $roomUid)->get();
		return response()->json($sceances, 200);
	}

	public function show($cinemaUid, $roomUid, $uid)
	{
		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();
		return response()->json($sceance, 200);
	}

	public function store(Request $request, $cinemaUid, $roomUid)
	{
		$request->validate([
			'uid' => 'required|uuid',
			'movie' => 'required|uuid',
			'date' => 'required|date',
		]);

		$sceance = Sceance::create([
			'uid' => $request->uid,
			'room_uid' => $roomUid,
			'movie' => $request->movie,
			'date' => $request->date,
		]);

		return response()->json($sceance, 201);
	}

	public function update(Request $request, $cinemaUid, $roomUid, $uid)
	{
		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();

		$request->validate([
			'movie' => 'uuid',
			'date' => 'date',
		]);

		$sceance->update($request->only(['movie', 'date']));

		return response()->json($sceance, 200);
	}

	public function destroy($cinemaUid, $roomUid, $uid)
	{
		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();
		$sceance->delete();

		return response()->noContent();
	}
}
