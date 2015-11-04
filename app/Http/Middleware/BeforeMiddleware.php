<?php

namespace App\Http\Middleware;

use Closure;

class BeforeMiddleware
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
        $request->header('Access-Control-Allow-Origin: *')
        ->header('Access-Control-Allow-Methods: PATCH, POST, PUT, DELETE, GET, OPTIONS')
        ->header('Access-Control-Allow-Headers: Range, Origin, Content-Type, Accept, Authorization, X-Request-With, X-CSRF-Token, X-XSRF-Token, XSRF-Token')
        ->header('Access-Control-Expose-Headers: Accept-Ranges, Content-Encoding, Content-Length, Content-Range');
        return $next($request);
    }
}
