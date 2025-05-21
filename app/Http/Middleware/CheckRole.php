<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        $rolesArray = is_array($roles) ? $roles : [$roles];

        if (!$user || !$user->hasAnyRole($rolesArray)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
