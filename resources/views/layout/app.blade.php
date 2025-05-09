<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap 5.3.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/flatly/bootstrap.min.css" />
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        #principal {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 200px; /* Añadido para evitar que el contenido se oculte detrás del footer */
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

    </style>
</head>
<body>
    <div id="principal">
        <x-header />
        <main id="container">
            @yield('content')
        </main>
        <x-footer/>
    </div>
    <!-- Bootstrap 5.3.0 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

