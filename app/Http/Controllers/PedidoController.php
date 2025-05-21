<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['empleado', 'producto'])->paginate(10);
        return view('pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::with(['empleado', 'producto'])->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function pdf($id)
    {
        $pedido = Pedido::with(['empleado', 'producto'])->findOrFail($id);
        $pdf = Pdf::loadView('pedidos.pdf', compact('pedido'));
        return $pdf->download('pedido_'.$pedido->id.'.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = \App\Models\Producto::findOrFail($request->producto_id);

        // Verificar stock suficiente
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock para este producto.');
        }

        // Calcular total
        $total = $producto->precio * $request->cantidad;

        // Crear el pedido
        $pedido = \App\Models\Pedido::create([
            'empleado_id' => $request->empleado_id,
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'total' => $total,
        ]);

        // Actualizar el stock
        $producto->stock -= $request->cantidad;
        $producto->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente.');
    }
    public function create()
    {
        $empleados = \App\Models\Empleado::all();
        $productos = \App\Models\Producto::all();
        return view('pedidos.create', compact('empleados', 'productos'));
    }
}
