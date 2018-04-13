<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
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
    
    <div>
        @yield('content')
    </div>
</body>

</html>