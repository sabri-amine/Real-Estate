<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;


class Authenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
    public function handle(Request $request, Closure $next)
    {
        // Check if session variable exists and is true
        if (!session('authenticated')) {
            return redirect('/login')->with('error', 'Accès non autorisé');
        }

        // Check if user is not authenticated
        if (!$request->user()) {
            return redirect('/login')->with('error', 'Veuillez vous connecter');
        }
        return $next($request);
    }
}
