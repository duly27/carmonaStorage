<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="icon" href="{{ asset('images/icono.gif') }}" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap 5.3.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/flatly/bootstrap.min.css" />
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.getEntriesByType("navigation")[0].type === "back_forward")) {
                window.location.reload();
            }
        });
    </script>
    <style>
        header{
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        html, body {
            height: 100%;
            margin: 0;
            margin-top: 2.5%;

        }

        #principal {
            min-height:100dvh;
            display: flex;
            flex-direction: column;
        }

        #container {
            height: 100%;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        footer {
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .pagination-wrapper nav > div:first-child {
            display: flex;
            gap: 4px;
            justify-content: center;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span {
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 4px;
            background: #eee;
        }

        nav svg {
            width: 12px;
            height: 12px;
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

</body>

</html>

