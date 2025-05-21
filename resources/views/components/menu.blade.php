<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('pedidos.index') }}">Pedidos</a>
                    </li>
                    @if (Auth::user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('productos.create') }}">Alta Producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('empleados.index') }}">Empleados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('empleados.create') }}">Alta Empleado</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('Vendedor'))
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
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('showlogin') }}">Iniciar Sesión</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

