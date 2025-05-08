@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Listado de Empleados</h2>
    <main>
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se llenarán los empleados dinámicamente -->
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
