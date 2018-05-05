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
                        <table>
                            <thead>
                                <tr>
                                    <th class="center-align">Veterinario</th>
                                    <th class="center-align">Dia</th>
                                    <th class="center-align">Detalles</th>
                                </tr>
                            </thead>
                            <tbody id="{{$mascota->id}}">
                                @foreach($mascota->consultas as $consulta)
                                    @if($consulta->Estado == 4)
                                        <tr>
                                            <td class="center-align">{{$consulta->veterinario->name}}</td>
                                            <td class="center-align">{{$consulta->FechaConsulta}}</td>
                                            <td class="center-align">
                                                <a title="Detalles de consulta" href="/detallesConsulta/{{$consulta->id}}" class="modal-trigger btn-floating"><i class="material-icons">check</i></a>
                                            </td>
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