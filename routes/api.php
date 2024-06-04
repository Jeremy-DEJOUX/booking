<?php

use App\Http\Controllers\Api\CinemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

Route::get('/cinemas', [CinemaController::class, 'index']);
Route::get('/cinema/{uid}', [CinemaController::class, 'show']);
Route::post('/cinema', [CinemaController::class, 'store']);
Route::put('/cinema/{uid}', [CinemaController::class, 'update']);
Route::delete('/cinema/{uid}', [CinemaController::class, 'remove']);
