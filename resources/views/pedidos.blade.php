@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Listado de Pedidos</h2>
    <main>
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se llenarán los pedidos dinámicamente -->
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
