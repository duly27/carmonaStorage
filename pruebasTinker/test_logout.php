<?php

use App\Models\User;
use Illuminate\Http\Request;

try {
    // Simula una solicitud autenticada
    $request = new Request();
    $request->setUserResolver(function () {
        $user = User::where('email', 'admin@example.com')->first();

        if (!$user) {
            throw new Exception('El usuario admin@example.com no existe.');
        }

        return $user;
    });

    // Llama al método logout del controlador
    $response = (new App\Http\Controllers\AuthController)->logout($request);

    // Muestra la respuesta
    print_r($response->getData());
} catch (Exception $e) {
    // Maneja la excepción si el usuario no existe
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
