@extends('layouts.logueado') 

@section('title','Consultas') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('icon','assignment')
@section('nav','Consultas') 

@section('content')
<link rel="stylesheet" href="../../css/jPages.css">
<script type="text/javascript" src="../../js/jpage.js"></script>
<div class="row" id="cont">
    <div class="col xl9 offset-xl3">
        <div class="row">
            <div class="col xl12">
                <div class="row">
                    @foreach($cliente->mascotas as $mascota)
                        <h3>Consultas de: {{$mascota->NombreMascota}}</h3>
                        <table >
                            <thead>
                                <tr>
                                    <th>Veterinario</th>
                                    <th>Dia</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody id="{{$mascota->id}}">
                                @foreach($mascota->consultas as $consulta)
                                    @if($consulta->Estado == 4)
                                        <tr>
                                            <td>{{$consulta->veterinario->name}}</td>
                                            <td>{{$consulta->FechaConsulta}}</td>
                                            <td><input type="button" value=""></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="holder {{$mascota->id}}"></div>
                        <script type="text/javascript">
                            $('.{{$mascota->id}}').jPages({
                                containerID: '{{$mascota->id}}',
                                perPage: 5
                            });
                        </script>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection