<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Verifica si el usuario ya existe
$user = User::where('email', 'admin@example.com')->first();

$result = []; // Almacena los resultados de la operación

if ($user) {
    // Elimina el usuario existente
    $user->delete();
    $result['status'] = 'success';
    $result['message'] = 'Usuario admin existente eliminado.';
} else {
    $result['status'] = 'info';
    $result['message'] = 'No se encontró un usuario admin existente.';
}

// Crea el usuario
$newUser = User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => Hash::make('admin123'),
    'role' => 'admin',
]);

$result['status'] = 'success';
$result['message'] = 'Usuario admin creado con éxito.';
$result['user'] = [
    'name' => $newUser->name,
    'email' => $newUser->email,
    'role' => $newUser->role,
];

// Devuelve los resultados
print_r($result);
