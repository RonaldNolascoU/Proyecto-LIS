@extends('layouts.logueado') 

@section('title','Perfil') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('icon','pets')
@section('nav','Mascotas') 

@section('content')
<div class="row" id="cont">
    <div class="col xl9 offset-xl3">
        <div class="row">
            <div class="col xl12">
                <div class="row">
                    @foreach($cliente->mascotas as $mascota)
                        <div class="col xl4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="img/Mascotas/{{$mascota->imagen}}">
                                    <a href="{{route('Mascota.show',$mascota->id)}}" class="btn-floating btn-large halfway-fab waves-effect waves-light blue">
                                        <i class="material-icons">add</i>
                                    </a>
                                </div>
                                <div class="card-content">
                                    <span class="card-title">{{$mascota->NombreMascota}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection