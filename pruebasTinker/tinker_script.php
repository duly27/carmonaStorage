<?php
include 'c:/Users/LemOwO/carmonaStorage/pruebasTinker/tinker_script.php';

// filepath: c:\Users\LemOwO\carmonaStorage\almacen\tinker_script.php
use App\Models\User;
use Illuminate\Http\Request;

// Simula una solicitud de inicio de sesión
$request = new Request([
    'email' => 'admin@example.com',
    'password' => 'admin123',
]);


// Llama al método login del controlador
$response = (new App\Http\Controllers\AuthController)->login($request);

// Devuelve la respuesta
dd($response);
