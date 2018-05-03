<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="../../css/user.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @yield('head')
        <script src="../../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <script type="text/javascript" src="../../js/inicializacion.js"></script>
    </head>
<body>
    <ul id="dropdown1" class="dropdown-content">
        <li></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <nav>
        <div class="nav-wrapper teal lighten-2">
            <a href="#!" class="brand-logo">StarPets</a>
            <ul class="right hide-on-med-and-down">
                    @guest
                        <li><a href="/">Login de clientes</a></li>
                        <li><a href="{{route('login')}}">Login de usuarios</a></li>
                    @else 
                        @if(Auth::user()->roles()->first()->Name == "Veterinario")
                            <li>
                                <a href="{{route('Consulta.index')}}"><i class="material-icons left">import_contacts</i>Consulta</a>
                            </li>
                            <li>
                                <a href="/home"><i class="material-icons left">home</i>Inicio</a>
                            </li>
                        @endif
                        @if(Auth::user()->roles()->first()->Name == "Secretaria")
                            <li>
                                <a href="{{route('Consulta.index')}}"><i class="material-icons left">import_contacts</i>Consultas</a>
                            </li>
                            <li>
                                <a href="{{route('Consulta.create')}}"><i class="material-icons left">add</i>Ingresar consultas</a>
                            </li>
                            <li>
                                <a href="/home"><i class="material-icons left">home</i>Inicio</a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{Auth::user()->name}}
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    @endguest
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col xl12 card horizontal" >
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
