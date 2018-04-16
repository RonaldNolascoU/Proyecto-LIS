@extends('layouts.logueado') 

@section('title','Perfil') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('nav','Perfil') 

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xl10 offset-xl2">
                <h2>Hola</h2>
            </div>
        </div>
    </div>
@endsection