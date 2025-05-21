@extends('layout.app')

@section('content')
<div class="container ">
    <h2 class="text-center text-primary">Alta de Empleado</h2>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf  <!-- Protección contra CSRF -->

        <!-- Campo de Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese el nombre del empleado">
        </div>

        <!-- Campo de Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Ingrese el email del empleado">
        </div>

        <!-- Campo de Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required maxlength="15" placeholder="Ingrese el teléfono del empleado">
        </div>

        <!-- Campo de Dirección -->
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required placeholder="Ingrese la dirección del empleado">
        </div>

        <!-- Campo de Puesto -->
        <div class="form-group">
            <label for="puesto">Puesto:</label>
            <input type="text" class="form-control" id="puesto" name="puesto" required placeholder="Ingrese el puesto del empleado">
        </div>

        <!-- Botones de acción -->
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver al listado</a>
    </form>
</div>
@endsection
