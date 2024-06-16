<?php

// app/Http/Controllers/ReservationController.php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Sceance;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\ProcessReservation;

class ReservationController extends Controller
{
	protected $movieService;

	public function __construct(MovieService $movieService)
	{
		$this->movieService = $movieService;
	}

	public function store(Request $request, $movieUid)
	{
		// Vérifiez l'existence du film dans le service de films
		$movie = $this->movieService->getMovie($movieUid);

		if (isset($movie['error'])) {
			return response()->json(['error' => 'Movie not found'], 404);
		}

		// Valider les données de la requête
		$request->validate([
			'sceance' => 'required|uuid|exists:sceances,uid',
			'nbSeats' => 'required|integer|min:1',
			'room' => 'required|uuid|exists:rooms,uid',
		]);

		// Créer la réservation
		$reservation = Reservation::create([
			'uid' => (string) Str::uuid(),
			'sceance_uid' => $request->sceance,
			'rank' => 0,
			'status' => 'open',
			'seats' => $request->nbSeats,
		]);

		// Envoyer la tâche à la queue RabbitMQ
		ProcessReservation::dispatch($reservation);

		return response()->json($reservation, 201);
	}

	public function confirm($uid)
	{
		$reservation = Reservation::where('uid', $uid)->firstOrFail();

		if ($reservation->status !== 'open') {
			return response()->json(['error' => 'Reservation cannot be confirmed'], 422);
		}

		$reservation->status = 'confirmed';
		$reservation->save();

		// Logique supplémentaire pour confirmer la réservation

		return response()->json($reservation, 201);
	}

	public function index($movieUid)
	{
		$reservations = Reservation::whereHas('sceance', function ($query) use ($movieUid) {
			$query->where('movie', $movieUid);
		})->get();

		return response()->json($reservations, 200);
	}

	public function show($uid)
	{
		$reservation = Reservation::where('uid', $uid)->firstOrFail();
		return response()->json($reservation, 200);
	}
}
