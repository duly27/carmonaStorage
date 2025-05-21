{{-- filepath: c:\Users\LemOwO\carmonaStorage\almacen\resources\views\pedidos\show.blade.php --}}
@extends('layout.app')
@section('content')
<div class="container">
    <h2 class="text-center text-primary">Detalle del Pedido #{{ $pedido->id }}</h2>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Empleado:</strong> {{ $pedido->empleado->nombre }}</li>
        <li class="list-group-item"><strong>Producto:</strong> {{ $pedido->producto->nombre }}</li>
        <li class="list-group-item"><strong>Cantidad:</strong> {{ $pedido->cantidad }}</li>
        <li class="list-group-item"><strong>Precio Unitario:</strong> {{ $pedido->producto->precio }}</li>
        <li class="list-group-item"><strong>Total:</strong> {{ $pedido->total }}</li>
        <li class="list-group-item"><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</li>
    </ul>
    <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-secondary">Descargar PDF</a>
    <a href="{{ route('pedidos.index') }}" class="btn btn-primary">Volver al listado</a>
</div>
@endsection
