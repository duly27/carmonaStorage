<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <!-- Botón para el menú en pantallas pequeñas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces del menú -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('index') }}">Inicio</a>
                </li>

                <!-- Si el usuario está autenticado -->
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('productos.index') }}">Productos</a>
                    </li>

                    <!-- Opciones para Admin -->
                    @if (Auth::user()->role === 'Admin')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('empleados.index') }}">Empleados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('empleados.create') }}">Alta Empleado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('pedidos.index') }}">Pedidos</a>
                        </li>
                    @endif

                    <!-- Opciones para Gerente -->
                    @if (Auth::user()->role === 'Gerente')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('pedidos.index') }}">Pedidos</a>
                        </li>
                    @endif

                    <!-- Opciones para Vendedor -->
                    @if (Auth::user()->role === 'Vendedor')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('productos.index') }}">Ver Productos</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                        </form>
                    </li>
                @else
                    <!-- Si el usuario no está autenticado -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('showlogin') }}">Iniciar Sesión</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
