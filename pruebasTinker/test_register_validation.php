<?php

use Illuminate\Http\Request;

// Simula una solicitud de registro con un correo duplicado
$request = new Request([
    'name' => 'Duplicate User',
    'email' => 'admin@example.com', // Correo ya existente
    'password' => 'password123',
    'password_confirmation' => 'password123',
]);

// Llama al método register del controlador
$response = (new App\Http\Controllers\AuthController)->register($request);

// Muestra la respuesta
print_r($response->getData());
