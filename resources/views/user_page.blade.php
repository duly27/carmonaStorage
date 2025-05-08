@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h2 class="text-center text-success">
        Bienvenido, {{ Auth::user()->name }}
    </h2>
    <main>
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <div class="text-center mt-4">
            <p class="text-muted">
                <h2><strong>Rol:</strong> {{ Auth::user()->role }}</h2>
            </p>
        </div>
        <div class="text-center mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
            </form>
        </div>
    </main>
</div>
@endsection
