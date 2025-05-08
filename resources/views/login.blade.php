@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h2 class="text-center text-success">
        Inicia Sesión
    </h2>
    <main>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('loginuser') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
        </form>
    </main>
</div>
@endsection
