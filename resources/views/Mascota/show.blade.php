@extends('layouts.logueado') 

@section('title','Mascota') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('icon','pets')
@section('nav','Mascota') 

@section('content')
<div class="row" id="cont">
    <div class="col xl10 offset-xl2">
        <div class="row">
            <div class="col xl12">
                <div class="row">
                    <div class="col xl12 center-align">
                        <h2>{{$mascota->NombreMascota}}</h2>
                    </div>
                    <div class="col xl12 center-align">
                        <br>
                        <img src="../img/Mascotas/{{$mascota->imagen}}" alt="Imagen de perfil" class="circle">
                        <a id="btn-img" title="Cambiar imagen" href="#modal5" class="modal-trigger blue btn-floating btn-large">
                            <i class="material-icons">cached</i>
                        </a>
                    </div>
                    <div class="col xl10 offset-xl2">
                        <div class="row">
                            <div class="col xl6">
                                <h5>
                                    <strong>Fecha de nacimiento: </strong>{{$mascota->FechaNacimiento}}</h5>
                            </div>
                            <div class="col xl6">
                                <h5>
                                    <strong>Tipo: </strong>{{$mascota->tipo->NombreTipo}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col xl11 offset-xl1">
                        <div class="row">
                            <div class="col xl6 center-align">
                                    <a id="btn-img" title="Ingresar caracteristica" href="#modal4" class="modal-trigger waves-effect waves-light btn teal">
                                        <i class="material-icons left">add_circle_outline</i>Ingresar caracteristica</a>
                            </div>
                            <div class="col xl6 center-align">
                                <form id="eliminar" action="{{action('MascotaController@destroy',$mascota->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button id="btnEliminarMascota" class="waves-effect waves-light btn red" type="button" name="action">
                                        <i class="material-icons left">do_not_disturb_on</i>Eliminar mascota</a>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col xl11 offset-xl1">
                        <div class="row">
                            <div class="col xl10 offset-xl1">
                                <ul class="collection with-header">
                                    <li class="collection-header">
                                        <h4>Caracteristicas</h4>
                                    </li>
                                    @foreach($mascota->caracteristicas as $caracteristica)
                                        <li class="collection-item">
                                            <div>{{$caracteristica->DescripcionCaracteristica}}
                                                <form id="EC-{{$caracteristica->id}}" class="secondary-content btn-min" action="{{route('Caracteristica.destroy',$caracteristica->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn-floating waves-effect waves-light red btn-small" type="button" onclick="eliminarCaracteristica('{{$caracteristica->id}}')" name="action">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal4" class="modal">
    <div class="modal-content">
        <h4 class="teal-text">Agregar caracteristica</h4>
        <div class="container">
            <form method="post" id="frmImagen" action="{{route('Caracteristica.store')}}">
                {{ csrf_field() }}
                <div class="row">
                    <input type="hidden" name="id" value="{{$mascota->id}}">
                    <div class="input-field col xl12">
                        <i class="material-icons prefix">add_circle_outline</i>
                        <input id="Caracteristica" name="Caracteristica" type="text" class="validate">
                        <label for="Caracteristica">Caracteristica</label>
                    </div>
                    <div class="col xl12 center-align">
                        <button type="submit" id="btnAgregar" class="btn waves-effect waves-light white-text" name="action">
                            Agregar
                            <i class="material-icons right">add</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat option">Cancelar</a>
    </div>
</div>
<div id="modal5" class="modal">
    <div class="modal-content">
        <h4 class="teal-text">Cambiar imagen</h4>
        <div class="container">
            <form method="post" id="frmImagen" action="imagen" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col xl4">
                        <img class="circle cambio" src="../img/Mascotas/{{$mascota->imagen}}" alt="">
                        <br>
                        <center>
                            <span>Imagen actual</span>
                        </center>
                    </div>
                    <div class="col xl4">
                        <br>
                        <br>
                        <br>
                        <input class="hidden" id="files" name="files" type="file" class="validate" accept="image/png, .jpeg, .jpg" required/>
                        <input type="hidden" name="id" value="{{$mascota->id}}">
                    </div>
                    <div class="col xl4">
                        <output id="list"></output>
                        <br>
                        <center>
                            <span id="nv"></span>
                        </center>
                    </div>
                    <div class="col xl12 center-align">
                        <button type="submit" id="btnCambiar" class="btn waves-effect waves-light white-text" name="action">
                            Cambiar
                            <i class="material-icons right">autorenew</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat option">Cancelar</a>
    </div>
</div>
<script type="text/javascript" src="../../js/confirmacion.js"></script>
<script type="text/javascript" src="../../js/imagen.js"></script>
@endsection