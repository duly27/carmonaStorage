<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

/**
 * API Routes
 */

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', function (Request $request) {
        return response()->json([
            'message' => 'Usuario autenticado',
            'user' => $request->user()
        ]);
    });
});
