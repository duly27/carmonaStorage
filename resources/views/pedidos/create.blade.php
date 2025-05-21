{{-- filepath: c:\Users\LemOwO\carmonaStorage\almacen\resources\views\pedidos\create.blade.php --}}
@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Crear Pedido</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="empleado_id">Empleado:</label>
            <select class="form-control" id="empleado_id" name="empleado_id" required>
                <option value="">Seleccione un empleado</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="producto_id">Producto:</label>
            <select class="form-control" id="producto_id" name="producto_id" required onchange="mostrarStock()">
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}">
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </select>
            <small id="stock-info" class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-3">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="{{ old('cantidad', 1) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Crear Pedido</button>
        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>

<script>
function mostrarStock() {
    var select = document.getElementById('producto_id');
    var stockInfo = document.getElementById('stock-info');
    var selected = select.options[select.selectedIndex];
    var stock = selected.getAttribute('data-stock');
    if(stock !== null) {
        stockInfo.textContent = 'Stock disponible: ' + stock;
    } else {
        stockInfo.textContent = '';
    }
}
document.addEventListener('DOMContentLoaded', mostrarStock);
</script>
@endsection
