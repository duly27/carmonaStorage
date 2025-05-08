<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Muestra la lista de productos.
     *
     * @return \Illuminate\View\View
     */
    public function productos()
    {
        // Aquí puedes cargar los productos desde la base de datos
        $productos = []; // Reemplaza con tu lógica para obtener productos

        return view('info.productos', compact('productos'));
    }

    /**
     * Muestra la lista de categorías.
     *
     * @return \Illuminate\View\View
     */
    public function categorias()
    {
        // Aquí puedes cargar las categorías desde la base de datos
        $categorias = []; // Reemplaza con tu lógica para obtener categorías

        return view('info.categorias', compact('categorias'));
    }

    /**
     * Muestra la lista de proveedores.
     *
     * @return \Illuminate\View\View
     */
    public function proveedores()
    {
        // Aquí puedes cargar los proveedores desde la base de datos
        $proveedores = []; // Reemplaza con tu lógica para obtener proveedores

        return view('info.proveedores', compact('proveedores'));
    }
}
