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
    echo "Usuario admin creado para la prueba de roles.\n";
}

// Verifica los roles del usuario
$hasAdminRole = $user->hasRole('admin');
$hasManagerRole = $user->hasRole('manager');
$hasAnyRole = $user->hasAnyRole(['admin', 'manager']);

// Muestra los resultados
print_r([
    'hasAdminRole' => $hasAdminRole,
    'hasManagerRole' => $hasManagerRole,
    'hasAnyRole' => $hasAnyRole,
]);
