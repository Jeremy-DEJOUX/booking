<?php

namespace App\Http\Controllers;

use App\Models\Sceance;
use Carbon\Carbon;
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
			'movie' => 'required|string|max:255',
			'date' => 'required|date',
		]);

		$sceance = new Sceance();
		$sceance->uid = Str::uuid()->toString();
		$sceance->room_uid = $roomUid;
		$sceance->movie = $request->movie;
		$sceance->date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
		$sceance->save();

		return response()->json($sceance, 201);
	}


	public function update(Request $request, $cinemaUid, $roomUid, $uid)
	{
		$request->validate([
			'movie' => 'sometimes|required|string|max:255',
			'date' => 'sometimes|required|date',
		]);

		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();

		if ($request->has('movie')) {
			$sceance->movie = $request->movie;
		}

		if ($request->has('date')) {
			$sceance->date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
		}

		$sceance->save();

		return response()->json($sceance, 200);
	}


	public function destroy($cinemaUid, $roomUid, $uid)
	{
		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();
		$sceance->delete();

		return response()->json('delete', 200);
	}
}
