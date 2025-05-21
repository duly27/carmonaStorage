<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de productos.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
        $productos = Producto::when($busqueda, function ($query, $busqueda) {
            return $query->where('nombre', 'like', "%$busqueda%");
        })->paginate(10);

        return view('productos', compact('productos', 'busqueda'));
    }

    /**
     * Muestra el formulario para editar un producto.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos_edit', compact('producto'));
    }

    /**
     * Actualiza un producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->only(['nombre', 'descripcion', 'precio', 'stock']));

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('alta_productos');
    }
    /**
     * Almacena un nuevo producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Producto::create($request->only(['nombre', 'descripcion', 'precio', 'stock']));

        // Redirige a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }
}
