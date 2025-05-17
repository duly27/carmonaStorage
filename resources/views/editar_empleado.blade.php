@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Editar Empleado</h2>
    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $empleado->email) }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $empleado->telefono) }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $empleado->direccion) }}" required>
        </div>

        <div class="form-group">
            <label for="puesto">Puesto:</label>
            <input type="text" class="form-control" name="puesto" value="{{ old('puesto', $empleado->puesto) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
<!-- Este archivo es una vista de Blade que permite editar la información de un empleado existente.
     Se utiliza el método PUT para actualizar los datos en la base de datos.
     Se incluyen campos para nombre, email, teléfono, dirección y puesto,
     y se muestra un botón para enviar el formulario y otro para cancelar la edición. -->
