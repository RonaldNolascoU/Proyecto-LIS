<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('head')
</head>

<body>

    <nav>
        <div class="nav-wrapper teal lighten-2">
            <a href="#!" class="brand-logo">StarPets</a>
            <ul class="right hide-on-med-and-down">
                <li>
                    <a href="/"><i class="material-icons left">home</i>Inicio</a>
                </li>
                <li>
                    <a href="{{route('Cliente.create')}}"><i class="material-icons left">assignment</i>Registrate</a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

</html>