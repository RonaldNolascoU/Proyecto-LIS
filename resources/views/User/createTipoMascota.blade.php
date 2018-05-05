@extends('layouts.user') 

@section('title','Ingresar usuario') 

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="col xl12">
        <div class="row">
            <div class="col xl12">
                <div class="row">
                    <div class="container" id="panel">
                        <div class="row">
                            <div class="col xl12 center-align teal-text">
                                <h4>Registrar tipo de mascota</h4>
                            </div>
                            <form class="col xl12" action="{{route('TipoMascota.store')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">pets</i>
                                    <input id="Nombre" name="Nombre" type="text" class="validate" required>
                                    <label for="Nombre">Nombre</label>
                                </div>
                                <div class="col xl4 offset-xl8 s5 offset-s3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection