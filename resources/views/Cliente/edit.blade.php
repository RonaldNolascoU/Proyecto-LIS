@extends('layouts.logueado') 

@section('title','Perfil') 

@section('head')
@endsection 

@section('nombre', $cliente->PrimerNombre." ".$cliente->PrimerApellido)
@section('email', $cliente->correo)
@section('imagen', $cliente->imagen)
@section('icon','autorenew')
@section('nav','Modificar') 

@section('content')
<div class="row" id="cont">
    <div class="col xl9 offset-xl3" id="reg">
        <div class="row">
            <div class="container">
            <br>
            <form action="{{route('Cliente.update',$cliente->id)}}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="row">
                <div class="col xl12" id="login">
                    <div class="input-field col xl6 s12">
                        <i class="material-icons prefix">contacts</i>
                        <input id="PrimerNombre" name="PrimerNombre" value="{{$cliente->PrimerNombre}}" type="text" class="validate" required>
                        <label for="PrimerNombre">Primer Nombre</label>
                    </div>
                    <div class="input-field col xl6 s12">
                        <i class="material-icons prefix">contacts</i>
                        <input id="SegundoNombre" name="SegundoNombre" value="{{$cliente->SegundoNombre}}" type="text" class="validate" required>
                        <label for="SegundoNombre">Segundo Nombre</label>
                    </div>
                    <div class="input-field col xl6 s12">
                        <i class="material-icons prefix">contacts</i>
                        <input id="PrimerApellido" name="PrimerApellido" value="{{$cliente->PrimerApellido}}" type="text" class="validate" required>
                        <label for="PrimerApellido">Primer Apellido</label>
                    </div>
                    <div class="input-field col xl6 s12">
                        <i class="material-icons prefix">contacts</i>
                        <input id="SegundoApellido" name="SegundoApellido" value="{{$cliente->SegundoApellido}}" type="text" class="validate" required>
                        <label for="SegundoApellido">Segundo Apellido</label>
                    </div>
                    <div class="input-field col xl6 s12">
                        <i class="material-icons prefix">call</i>
                        <input id="Telefono" name="Telefono" value="{{$cliente->telefono}}" type="text" class="validate" required>
                        <label for="Telefono">Telefono</label>
                    </div>
                    <div class="col xl4 offset-xl8 s5 offset-s3">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Modificar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                </div>
            </form>
            <br><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>
@endsection