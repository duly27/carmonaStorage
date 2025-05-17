<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Middleware personalizado para evitar cache y control acceso a login cuando ya está logueado
use App\Http\Middleware\NoBackMiddleware;

// Ruta pública principal
Route::get('/', function () {
    return view('index');
})->name('index');

// Ruta pública para categorías
Route::get('/categorias', [InfoController::class, 'categorias'])->name('categorias.index');

// Rutas solo para invitados (usuarios NO autenticados)
// Middleware guest + NoBackMiddleware para evitar cache y evitar acceso a login si ya estás autenticado
Route::middleware(['guest', NoBackMiddleware::class])->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('showlogin');
    Route::post('/login', [AuthController::class, 'login'])->name('loginuser');
});

// Rutas protegidas por autenticación + NoBackMiddleware para evitar cache y evitar que el back deje fuera sesión
Route::middleware(['auth', NoBackMiddleware::class])->group(function () {
    Route::get('/user_page', [AuthController::class, 'showUserPage'])->name('user_page');
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

    // Rutas para Admin (control de roles con middleware personalizado check.role)
    Route::middleware(['check.role:Admin'])->group(function () {
        Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
        Route::get('/empleados/crear', [EmpleadoController::class, 'create'])->name('empleados.create');
        Route::get('/empleados/{id}/editar', [EmpleadoController::class, 'edit'])->name('empleados.edit');
        Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
        Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
        Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');
    });

    // Rutas para Gerente y Admin
    Route::middleware(['check.role:Gerente,Admin'])->group(function () {
        Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    });

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Ruta fallback para URLs no definidas
Route::fallback(function () {
    return view('index');
});
