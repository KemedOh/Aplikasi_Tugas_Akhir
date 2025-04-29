<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role->role, $roles)) {
            // Debugging output
            dd(Auth::user()->role->role, $roles); // Untuk mengecek nilai role yang didapat
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}