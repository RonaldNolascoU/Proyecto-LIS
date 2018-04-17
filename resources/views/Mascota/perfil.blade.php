@extends('layouts.logueado') 

@section('title','Perfil') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre." ".$cliente->PrimerApellido)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('icon','filter_list')
@section('nav','Perfil') 

@section('content')
        <div class="row" id="cont">
            <div class="col xl10 offset-xl2">
                <div class="row">
                    <div class="col xl12 center-align">
                        <br>
                        <img src="../img/Clientes/{{$cliente->imagen}}" alt="Imagen de perfil" class="circle">
                        <a id="btn-img" title="Cambiar imagen" class="btn-floating btn-large"><i class="material-icons">cached</i></a>
                    </div>
                    <div class="col xl12 center-align">
                        <h2 class="principal">{{$cliente->PrimerNombre}} {{$cliente->SegundoNombre}} {{$cliente->PrimerApellido}} {{$cliente->SegundoApellido}}
                            
                            <hr>
                        </h2>
                        <br>
                        <a class="black-text option" href="">
                            <i class="material-icons">enhanced_encryption</i> Cambiar clave</a>
                    </div>
                    <div class="col xl10 offset-xl2">
                        <div class="col xl6">
                            <h5>
                                <strong>Telefono: </strong>{{$cliente->telefono}}</h5>
                        </div>
                        <div class="col xl6">
                            <h5>
                                <strong>Correo: </strong>{{$cliente->correo}}</h5>
                        </div>
                        <br>
                        <div class="col xl6">
                            <h5>
                                <strong>DUI: </strong>{{$cliente->DUI}}</h5>
                        </div>
                    </div>
                    <div class="col xl12 center-align">
                            <a class="waves-effect waves-light btn" href="{{action('ClienteController@edit',$cliente->id)}}"><i class="material-icons left">edit</i>Modificar</a>
                    </div>
                </div>
            </div>
        </div>
@endsection