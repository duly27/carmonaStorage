<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        return view('empleados');
    }

    public function create()
    {
        return view('alta_empleado');
    }
}
