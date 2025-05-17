@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Listado de Empleados</h2>
    <main>
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Puesto</th>
                        <th>Creado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->email }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->direccion }}</td>
                            <td>{{ $empleado->puesto }}</td>
                            <td>
                                <a href="{{ route('empleados.edit',[ $empleado->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
