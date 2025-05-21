<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\NoBackMiddleware as No;

// Ruta pública principal
Route::get('/', function () {
    return view('index');
})->name('index');

// Ruta pública para categorías
Route::get('/categorias', [InfoController::class, 'categorias'])->name('categorias.index');

// Invitados (NO autenticados)
Route::middleware(['guest', No::class])->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('showlogin');
    Route::post('/login', [AuthController::class, 'login'])->name('loginuser');
});

// Usuarios autenticados
Route::middleware(['auth', No::class])->group(function () {
    Route::get('/user_page', [AuthController::class, 'showUserPage'])->name('user_page');
    // Rutas de productos
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    // Rutas de empleados (antes solo Admin)
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/crear', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::get('/empleados/{id}/editar', [EmpleadoController::class, 'edit'])->name('empleados.edit');
    Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');

    // Rutas de pedidos (antes solo Gerente)
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/pedidos/{id}/pdf', [PedidoController::class, 'pdf'])->name('pedidos.pdf');
    Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Fallback para URLs no encontradas
Route::fallback(function () {
    return view('index');
});
