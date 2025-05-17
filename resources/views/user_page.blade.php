@if (!Auth::check())
    <script>
        window.location.href = '{{ route('showlogin') }}';  // Redirige al login si no está autenticado
    </script>
@endif

@extends('layout.app')

@section('content')
<head>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>

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
