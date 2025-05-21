{{-- filepath: c:\Users\LemOwO\carmonaStorage\almacen\resources\views\pedidos\index.blade.php --}}
@extends('layout.app')
@section('content')
<div class="container">
    <h2 class="text-center text-primary">Listado de Pedidos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->empleado->nombre }}</td>
                    <td>{{ $pedido->producto->nombre }}</td>
                    <td>{{ $pedido->cantidad }}</td>
                    <td>{{ $pedido->producto->precio }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm">Ver Detalle</a>
                        <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-secondary btn-sm">PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pedidos->links() }}
</div>
@endsection
