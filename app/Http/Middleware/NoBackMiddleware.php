<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class NoBackMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Configurar cabeceras para evitar el almacenamiento en caché
        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', '0');
    }
}

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', function () {
    if (Auth::check()) {
        // Si el usuario ya está autenticado, redirigir a su página principal
        return redirect()->route('user_page');
    }
    return view('login'); // Mostrar el formulario de inicio de sesión
})->name('login')->middleware(NoBackMiddleware::class);

