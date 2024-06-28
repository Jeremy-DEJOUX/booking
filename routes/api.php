<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SceanceController;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\IsAdmin;

Route::prefix('cinema')->group(function () {
	Route::get('/', [CinemaController::class, 'index']);
	Route::get('/{uid}', [CinemaController::class, 'show']);
	Route::post('/', [CinemaController::class, 'store'])->middleware(IsAdmin::class);
	Route::put('/{uid}', [CinemaController::class, 'update']);
	Route::delete('/{uid}', [CinemaController::class, 'remove'])->middleware(IsAdmin::class);

	Route::prefix('{cinemaUid}/rooms')->group(function () {
		Route::get('/', [RoomController::class, 'index']);
		Route::get('/{uid}', [RoomController::class, 'show']);
		Route::post('/', [RoomController::class, 'store'])->middleware(IsAdmin::class);
		Route::put('/{uid}', [RoomController::class, 'update'])->middleware(IsAdmin::class);
		Route::delete('/{uid}', [RoomController::class, 'destroy'])->middleware(IsAdmin::class);

		Route::prefix('{roomUid}/sceances')->group(function () {
			Route::get('/', [SceanceController::class, 'index']);
			Route::get('/{uid}', [SceanceController::class, 'show']);
			Route::post('/', [SceanceController::class, 'store'])->middleware(IsAdmin::class);
			Route::put('/{uid}', [SceanceController::class, 'update'])->middleware(IsAdmin::class);
			Route::delete('/{uid}', [SceanceController::class, 'destroy'])->middleware(IsAdmin::class);
		});
	});
});

Route::prefix('movie/{movieUid}/reservations')->group(function () {
	Route::post('/', [ReservationController::class, 'store']);
	Route::get('/', [ReservationController::class, 'index'])->middleware(IsAdmin::class);
});

Route::prefix('reservations/{uid}')->group(function () {
	Route::post('/confirm', [ReservationController::class, 'confirm']);
	Route::get('/', [ReservationController::class, 'show'])->middleware(IsAdmin::class);
});
