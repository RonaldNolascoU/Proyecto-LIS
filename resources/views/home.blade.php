@extends('layouts.app')
@section('title','Inicio')
@section('content')
<div class="container" id="home">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="col xl12">
                    <h5 class="teal-text center-align">Bienvenido</h5>
                </div>

                <div class="col xl12">
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
