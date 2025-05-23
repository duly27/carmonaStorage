<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoBackMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario ya está autenticado e intenta ir a /login, redirige a user_page
        if ($request->is('login') && Auth::check()) {
            return redirect()->route('user_page');
        }

        $response = $next($request);

        // Evita cache en el navegador para que al pulsar atrás no muestre páginas sin sesión activa
        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', '0');
    }
}
