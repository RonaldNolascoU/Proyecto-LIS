@extends('layouts.logueado') 

@section('title','Perfil') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)

@section('content')
    <h1>Hola</h1>
@endsection