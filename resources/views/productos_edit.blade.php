@extends('layout.app')

@section('content')
<div class="container ">
    <h2 class="text-center text-primary">Editar Producto</h2>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ old('nombre', $producto->nombre) }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required value="{{ old('descripcion', $producto->descripcion) }}">
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" class="form-control" id="precio" name="precio" required min="0" step="0.01" value="{{ old('precio', $producto->precio) }}">
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control" id="stock" name="stock" required min="0" value="{{ old('stock', $producto->stock) }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
