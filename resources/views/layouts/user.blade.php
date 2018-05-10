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
    <script type="text/javascript" src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    @if(Session::has('success'))
        <script type="text/javascript">
            $(document).ready(function(){
                swal("Completado","{{Session::get('success')}}","success");
            });
        </script>
    @endif
    @if(Session::has('prb'))
        <script type="text/javascript">
            $(document).ready(function(){
                swal("Error","{{Session::get('prb')}}","error");
            });
        </script>
    @endif
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
                @if(Auth::user()->roles()->first()->Name == "Veterinario")
                    <li>
                        <a href="{{route('Consulta.index')}}">
                            <i class="material-icons left">import_contacts</i>Consulta</a>
                    </li>
                    <li>
                        <a href="/home">
                            <i class="material-icons left">home</i>Inicio</a>
                    </li>
                @endif 
                @if(Auth::user()->roles()->first()->Name == "Secretaria")
                    <li>
                        <a href="{{route('Consulta.index')}}">
                            <i class="material-icons left">import_contacts</i>Consultas</a>
                    </li>
                    <li>
                        <a href="{{route('Consulta.create')}}">
                            <i class="material-icons left">add</i>Ingresar consultas</a>
                    </li>
                    <li>
                        <a href="/home">
                            <i class="material-icons left">home</i>Inicio</a>
                    </li>
                @endif
                 @if(Auth::user()->roles()->first()->Name == "Administrador")
                    <li>
                        <a href="{{route('TipoMedicamento.index')}}">
                            <i class="material-icons left">local_hospital</i>Tipos de medicamentos</a>
                    </li>
                    <li>
                        <a href="{{route('TipoMascota.index')}}">
                            <i class="material-icons left">pets</i>Tipos de mascotas</a>
                    </li>
                    <li>
                        <a href="{{route('User.index')}}">
                            <i class="material-icons left">perm_identity</i>Lista de usuarios</a>
                    </li>
                    <li>
                        <a href="/home">
                            <i class="material-icons left">home</i>Inicio</a>
                    </li>
                @endif
                <!-- Dropdown Trigger -->
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{Auth::user()->name}}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div  id="panel">
        @yield('content')
    </div>
</body>
</html>
