<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuth
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
        if(request()->bearerToken() !== $request->session()->get('token')){
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return $next($request);
    }
}
