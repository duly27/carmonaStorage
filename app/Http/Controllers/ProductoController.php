<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de productos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Aquí puedes cargar los productos desde la base de datos
        $productos = []; // Reemplaza con tu lógica para obtener productos

        return view('productos', compact('productos'));
    }
}
