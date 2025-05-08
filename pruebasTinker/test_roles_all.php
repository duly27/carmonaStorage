<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Define los roles a probar
$roles = ['admin', 'manager', 'employee', 'custom'];

// Resultados de las pruebas
$results = [];

foreach ($roles as $role) {
    // Verifica si el usuario con este rol ya existe
    $user = User::where('email', $role . '@example.com')->first();

    if ($user) {
        $user->delete();
        echo "Usuario con rol $role eliminado.\n";
    }

    // Crea un usuario con el rol actual
    $user = User::create([
        'name' => ucfirst($role) . ' User',
        'email' => $role . '@example.com',
        'password' => Hash::make($role . '123'),
        'role' => $role,
    ]);

    // Verifica si el usuario tiene su rol asignado correctamente
    $results[$role] = [
        'hasRole' => $user->hasRole($role),
        'hasAnyRole' => $user->hasAnyRole(['admin', 'manager', 'employee', 'custom']),
    ];

    // Limpia el usuario después de la prueba
    $user->delete();
}

// Muestra los resultados
print_r($results);
