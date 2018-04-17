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
@endsection