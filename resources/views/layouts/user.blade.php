<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title')</title>
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
    @if(Session::has('success'))
        <style>
            .toast{
                background-color: #4db6ac;
            }   
        </style>
        <script type="text/javascript">
            M.toast({html: "{{Session::get('success')}}"})
        </script>
    @endif
    @if(Session::has('prb'))
        <style>
            .toast{
                background-color: #d32f2f;
            }   
        </style>
        <script type="text/javascript">
            M.toast({html: "{{Session::get('prb')}}"})
        </script>
    @endif
    <ul id="dropdown1" class="dropdown-content">
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
                <li>
                    <a href="{{route('Consulta.index')}}"><i class="material-icons left">import_contacts</i>Consultas</a>
                </li>
                <li>
                    <a href="{{route('Consulta.create')}}"><i class="material-icons left">add</i>Ingresar consultas</a>
                </li>
                <li>
                    <a href="/home"><i class="material-icons left">home</i>Inicio</a>
                </li>
                <!-- Dropdown Trigger -->
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{Auth::user()->name}}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
                @yield('content')
        </div>
    </div>
</body>
</html>
