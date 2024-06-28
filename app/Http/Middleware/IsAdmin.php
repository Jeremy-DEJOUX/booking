<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IsAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		$token = $request->bearerToken();

		if (!$token) {
			return response()->json(['message' => 'Unauthorized'], 401);
		}

		// Call the authentication service to check if the user is an admin
		$response = Http::withToken($token)->get('http://host.docker.internal:8001/api/account/6672103dc26b5');
		$responseBody = $response->json();
		if ($response->successful() && isset($responseBody['roles']) && in_array('ROLE_ADMIN', $responseBody['roles'])) {
			return $next($request);
		}

		return response()->json(['message' => 'Forbidden'], 403);
	}
}
