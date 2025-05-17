<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registro de nuevo usuario
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
            'role' => 'user', // Asignamos un rol por defecto
        ]);

        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }

        $request->session()->regenerate();

        return redirect()->route('user_page')->with('success', 'Inicio de sesión exitoso.');
    }

    // Mostrar página principal de usuario
    // AuthController.php
    public function showUserPage()
    {
        if (!Auth::check()) {
            return redirect()->route('showlogin');
        }
        return view('user_page');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        // Cerrar sesión
        Auth::logout();

        // Invalidar la sesión y regenerar el token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir a la página de inicio (index) o login
        return redirect()->route('index'); // O usa 'showlogin' si prefieres ir a la página de login
    }
}
