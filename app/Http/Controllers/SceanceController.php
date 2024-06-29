<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Sceance;
use App\Services\MovieService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SceanceController extends Controller
{

	protected $movieService;

	public function __construct(MovieService $movieService)
	{
		$this->movieService = $movieService;
	}


	public function index($cinemaUid, $roomUid)
	{
		$sceances = Sceance::where('room_uid', $roomUid)->get();
		return response()->json($sceances, 200);
	}

	public function show($roomUid, $uid)
	{
		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();
		return response()->json($sceance, 200);
	}

	public function store(Request $request, $cinemaUid, $roomUid)
	{
		$movie = $this->movieService->getMovie($request->movie);
		if (isset($movie['error'])) {
			return response()->json(['error' => 'Movie not found'], 404);
		}
		$cinema = Cinema::find($cinemaUid);
		if (!$cinema) {
			return response()->json(['error' => 'Cinema not found'], 404);
		}
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
			'movie' => 'sometimes|required|int',
			'date' => 'sometimes|required|date',
		]);

		$sceance = Sceance::where('room_uid', $roomUid)->where('uid', $uid)->firstOrFail();

		$cinema = Cinema::find($cinemaUid);
		if (!$cinema) {
			return response()->json(['error' => 'Cinema not found'], 404);
		}

		$movie = $this->movieService->getMovie($request->movie);
		if (isset($movie['error'])) {
			return response()->json(['error' => 'Movie not found'], 404);
		}

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
