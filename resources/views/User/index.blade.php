@extends('layouts.user') 

@section('title','Lista de usurios') 

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="col xl12">
            <div class="row">
                <div class="col xl12">
                    <h4 class="center-align teal-text">Lista de usuarios</h4>
                </div>
                <div class="col xl12">
                    <div class="row">
                        <a class="waves-effect waves-light btn"><i class="material-icons right">add</i>Nuevo usuario</a>
                    </div>
                </div>
                <div class="col xl12">
                    <div class="row">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection