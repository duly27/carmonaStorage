<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Verifica si el usuario admin existe
$user = User::where('email', 'admin@example.com')->first();

if (!$user) {
    $user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);
    echo "Usuario admin creado para la prueba de tokens.\n";
}

// Genera un token para el usuario
$token = $user->createToken('TestToken')->plainTextToken;

// Muestra el token generado
print_r([
    'token' => $token,
]);
