@extends('layouts.login') 

@section('title','Index') 

@section('head')
    <link rel="stylesheet" href="../css/index.css"> 
@endsection 

@section('content')

@if(isset($errors))
    <style>
        .toast{
            background-color: #d32f2f;
        }   
    </style>
    <script type="text/javascript">
        M.toast({html: '{{$errors}}'})
    </script>
@endif

<div class="row">
    <div class="col s4"></div>
    <div class="col s4" id="reg">
        <div class="row">
            <form action="{{route('Cliente.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col s12" id="login">
                    <div class="col s12 teal lighten-2 white-text" id="enc">
                        <h4 class="center-align">
                            <img src="../img/paw-print-.png" alt="StarPets">
                            <br>Registro</h4>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">contacts</i>
                        <input id="PrimerNombre" name="PrimerNombre" type="text" class="validate">
                        <label for="PrimerNombre">Primer Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">contacts</i>
                        <input id="SegundoNombre" name="SegundoNombre" type="text" class="validate">
                        <label for="SegundoNombre">Segundo Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">contacts</i>
                        <input id="PrimerApellido" name="PrimerApellido" type="text" class="validate">
                        <label for="PrimerApellido">Primer Apellido</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">contacts</i>
                        <input id="SegundoApellido" name="SegundoApellido" type="text" class="validate">
                        <label for="SegundoApellido">Segundo Apellido</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">credit_card</i>
                        <input id="DUI" name="DUI" type="text" class="validate">
                        <label for="DUI">DUI</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">call</i>
                        <input id="Telefono" name="Telefono" type="text" class="validate">
                        <label for="Telefono">Telefono</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mail_outline</i>
                        <input id="Correo" name="Correo" type="text" class="validate">
                        <label for="Correo">Correo</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="Clave" name="Clave" type="password" class="validate">
                        <label for="Clave">Password</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">camera_alt</i>
                        <input id="Imagen" name="Imagen" type="file" class="validate">
                    </div>
                    <div class="col s5 offset-s7">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection