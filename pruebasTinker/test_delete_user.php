<?php

use App\Models\User;

// Obtén un usuario por su correo
$user = User::where('email', 'employee@example.com')->first();

// Elimina el usuario
if ($user) {
    $user->delete();
    $message = 'Usuario eliminado correctamente.';
} else {
    $message = 'Usuario no encontrado.';
}

// Muestra el resultado
print_r([
    'message' => $message,
]);
