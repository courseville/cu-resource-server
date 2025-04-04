<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
class CheckRoles
{
    public static function using(...$roles)
    {
        if (is_array($roles[0])) {
            return static::class.':'.implode(',', $roles[0]);
        }

        return static::class.':'.implode(',', $roles);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        $user = $request->user();

        if (!$user) {
            $client = auth('api')->client();
            if ($client) {
                // check if client has all the required roles
                foreach ($role as $r) {
                    if (!in_array($r, $client->roles->pluck('name')->toArray())) {
                        return response()->json(['error' => 'Unauthorized.'], 403);
                    }
                }
                return $next($request);
            }
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        // check if user has all the required roles
        foreach ($role as $r) {
            if (!in_array($r, $user->roles->pluck('name')->toArray())) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }
        }
        return $next($request);
    }
}
