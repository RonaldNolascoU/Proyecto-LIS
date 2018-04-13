<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="../css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('head')
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
    <header>
        <ul class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="background" id="bc">
                    </div>
                    <center>
                        <a href="#user">
                            <img class="circle" src="img/29750566_1797038173688907_295705052_n.png">
                        </a>
                    </center>
                    <a href="#name">
                        <span class="white-text name">John Doe</span>
                    </a>
                    <a href="#email">
                        <span class="white-text email">jdandturk@gmail.com</span>
                    </a>
                </div>
            </li>
            <li>
                <a href="#!">
                    <i class="material-icons">filter_list</i>Perfil</a>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">pets</i>Mascotas</div>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="material-icons">add</i>Ingresar mascota</a>
                                </li>
                                <li>
                                    <a href="#">
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
        </ul>
    </header>
    <main>
        @yield('content')
    </main>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large teal lighten-2">
            <i class="large material-icons">person</i>
        </a>
        <ul>
            <li>
                <a class="btn-floating green" title="Agregar mascota">
                    <i class="material-icons">add</i>
                </a>
            </li>
            <li>
                <a class="btn-floating yellow darken-1" title="Lista de mascotas">
                    <i class="material-icons">pets</i>
                </a>
            </li>
            <li>
                <a class="btn-floating blue" title="Perfil">
                    <i class="material-icons">filter_list</i>
                </a>
            </li>
        </ul>
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/inicializacion.js"></script>
</body>

</html>