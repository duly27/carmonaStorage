<?php

use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\NoBackMiddleware;

// Ruta de inicio (pública)
Route::get('/', function () {
    return view('index');
})->name('index');

// Ruta pública para categorías (sin autenticación)
Route::get('/categorias', [InfoController::class, 'categorias'])->name('categorias.index');

// Ruta para mostrar el formulario de inicio de sesión sin middleware de autenticación
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('showlogin')
    ->middleware(NoBackMiddleware::class);

// Rutas protegidas con autenticación y NoBackMiddleware
Route::middleware(['auth', NoBackMiddleware::class])->group(function () {
    // Página principal del usuario autenticado
    Route::get('/user_page', [LoginController::class, 'showUserPage'])->name('user_page');

    // Rutas para productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

    // Rutas para Admin
    Route::middleware([CheckRole::class . ':Admin'])->group(function () {
        Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
        Route::get('/empleados/crear', [EmpleadoController::class, 'create'])->name('empleados.create');
    });

    // Rutas para pedidos
    Route::middleware([CheckRole::class . ':Admin,Gerente'])->group(function () {
        Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    });
});

// Ruta para cerrar sesión (protegida con NoBackMiddleware)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para evitar páginas que no existen
Route::fallback(function () {
    return view('index');
});

// Ruta para iniciar sesión protegida con NoBackMiddleware
Route::post('/login', [AuthController::class, 'login'])->name('loginuser')->middleware(NoBackMiddleware::class);
