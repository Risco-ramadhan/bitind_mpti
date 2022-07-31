<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isUser() )
        {
            return $next($request);
        }

        return response()->json([
            'status' => 'Forbidden',
            'data' => null,
            'message' => 'You don’t have permission to request that URL',
            'ErrorCode' => 403,
        ],403);
    }
}
