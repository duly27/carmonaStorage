<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Registrar un nuevo usuario.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Iniciar sesión de un usuario.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (!Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }

        // Regenerar la sesión para evitar ataques de fijación de sesión
        $request->session()->regenerate();

        // Redirigir al usuario a la página principal
        return redirect()->route('user_page')->with('success', 'Inicio de sesión exitoso.');
    }

    /**
     * Muestra la página del usuario autenticado.
     */
    public function showUserPage()
    {
        return view('user_page');
    }

    /**
     * Cerrar sesión del usuario autenticado.
     */
    public function logout(Request $request)
    {
        // Cierra la sesión del usuario
        Auth::logout();

        // Invalida la sesión actual
        $request->session()->invalidate();

        // Regenera el token de la sesión
        $request->session()->regenerateToken();

        // Redirige al formulario de login
        return redirect()->route('showlogin');
    }
}
