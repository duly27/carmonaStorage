<?php

use App\Models\User;

// Obtén un usuario por su correo
$user = User::where('email', 'manager@example.com')->first();

// Actualiza el nombre del usuario
if ($user) {
    $user->update(['name' => 'Updated Manager']);
    $message = 'Usuario actualizado correctamente.';
} else {
    $message = 'Usuario no encontrado.';
}

// Muestra el resultado
print_r([
    'message' => $message,
    'user' => $user,
]);
