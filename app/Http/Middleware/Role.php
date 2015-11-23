<?php

namespace App\Http\Middleware;


use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = JWTAuth::parseToken()->authenticate();
        if ($user->type == '2') {
            return response()->json([], 403);
        }
        return $next($request);
    }
}
