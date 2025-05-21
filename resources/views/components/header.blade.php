<header class="bg-success text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Título y link del header -->
        <a href="{{ url('/') }}" class="text-white text-decoration-none">
            <h1 class="h3">CarmonaStorage</h1>
        </a>
        <!-- Llamada al menú -->
        @include('components.menu')
    </div>
</header>
