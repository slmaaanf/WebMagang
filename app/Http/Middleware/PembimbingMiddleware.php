<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'pembimbing') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses ditolak! Anda bukan pembimbing.');
    }
}
