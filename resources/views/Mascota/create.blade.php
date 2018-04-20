@extends('layouts.logueado') 

@section('title','Ingresar mascota') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('icon','pets')
@section('nav','Agregar mascota') 


@section('content')
<div class="row" id="cont">
    <div class="col xl9 offset-xl3" id="reg">
        <div class="row">
            <div class="container">
                <br>
                <form action="{{route('Mascota.store')}}" method="POST" id="frmMascota" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col xl12" id="login">
                            <div class="input-field col xl6 s12">
                                <i class="material-icons prefix">pets</i>
                                <input id="Nombre" name="Nombre" type="text" class="validate">
                                <label for="Nombre">Nombre</label>
                            </div>
                            <div class="input-field col xl6 s12">
                                <i class="material-icons prefix">av_timer</i>
                                <input id="Fecha" name="Fecha" type="date" class="validate">
                                <label for="Fecha">Fecha de nacimiento</label>
                            </div>
                            <div class="input-field col xl6 s12">
                                <i class="material-icons prefix">details</i>
                                <select name="Tipo" id="Tipo">
                                    <option value="" disabled selected>Choose your option</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->NombreTipo}}</option>
                                    @endforeach
                                </select>
                                <label>Tipo de mascota</label>
                            </div>
                            <div class="input-field col xl6 s12">
                                <i class="material-icons prefix">camera_alt</i>
                                <input id="Imagen" name="Imagen" type="file" class="validate" accept="image/png, .jpeg, .jpg" required>
                            </div>
                            <div class="col xl4 offset-xl8 s5 offset-s3">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Ingresar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                            <div class="col xl12">
                                <br>
                                <span>*Seleccione cuidadosamente el tipo de su mascota, ya que sino se encuentra entre los tipos a seleccionar la veterinaria no cuenta con la capacidad de atenderlo, de antemano gracias por su comprension </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection