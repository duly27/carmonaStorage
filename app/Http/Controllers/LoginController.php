<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('login'); // Asegúrate de que la vista 'login.blade.php' exista
    }

    /**
     * Muestra la página principal del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function showUserPage()
    {
        return view('user_page'); // Asegúrate de que la vista 'user_page.blade.php' exista
    }

    public function logout(Request $request)
    {
        auth()->guard()->logout();
        return redirect('/'); // Redirige a la página de inicio después de cerrar sesión
    }


}
