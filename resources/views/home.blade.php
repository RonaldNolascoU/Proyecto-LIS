@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido</div>

                <div class="panel-body">
                    <center>
                        <img src="img/animal-prints.png" alt="StarPets"><br>
                        <b>StarPets</b>
                    </center>
                    <span>Inicio de sesion con usuario {{Auth::user()->name}}</span><br>
                    <span>Nivel de acceso: {{Auth::user()->roles()->first()->Name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
