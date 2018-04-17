<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="../../css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('head')
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../js/materialize.min.js"></script>
    <script type="text/javascript" src="../../js/inicializacion.js"></script>
</head>

<body>
    @if(Session::has('success'))
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
    <header>
        <div class="top-nav" id="nav">
            <div class="container">
                <div class="nav-wrapper">
                    <div class="row">
                        <div class="col xl10 offset-xl2 s12">
                            <h1 class="header white-text center-align">
                                <i class="material-icons medium">@yield('icon')</i> @yield('nav')
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="background" id="bc">
                    </div>
                    <center>
                        <a href="../../perfil">
                            <img class="circle" src="../../img/Clientes/@yield('imagen')">
                        </a>
                    </center>
                    <a href="../../perfil">
                        <span class="white-text name">@yield('nombre')</span>
                    </a>
                    <a href="../../perfil">
                        <span class="white-text email">@yield('email')</span>
                    </a>
                </div>
            </li>
            <li>
                <a href="../../perfil">
                    <i class="material-icons">filter_list</i>Perfil
                </a>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li> 
                        <div class="collapsible-header" id="mv">
                            <i class="material-icons">pets</i>Mascotas
                        </div>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="#" id="mvd">
                                        <i class="material-icons">add</i>Ingresar mascota</a>
                                </li>
                                <li>
                                    <a href="{{route('Mascota.index')}}" id="mvd">
                                        <i class="material-icons">apps</i>Lista de mascota</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a href="../../cerrar">
                    <i class="material-icons">highlight_off</i>Cerrar Sesion
                </a>
            </li>
            <li>
                <div class="divider"></div>
            </li>
        </ul>
    </header>
    <main class="grey lighten-5">
        <div>
            @yield('content')
        </div>
    </main>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large teal lighten-2">
            <i class="large material-icons">person</i>
        </a>
        <ul>
            <li>
                <a class="btn-floating red" href="../../cerrar" title="Cerrar Sesion">
                    <i class="material-icons">highlight_off</i>
                </a>
            </li>
            <li>
                <a class="btn-floating green" title="Agregar mascota">
                    <i class="material-icons">add</i>
                </a>
            </li>
            <li>
                <a class="btn-floating yellow darken-1" href="{{route('Mascota.index')}}" title="Lista de mascotas">
                    <i class="material-icons">pets</i>
                </a>
            </li>
            <li>
                <a class="btn-floating blue" href="../../perfil" title="Perfil">
                    <i class="material-icons">filter_list</i>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>