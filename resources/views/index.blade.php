@extends('layouts.login') 

@section('title','Index') 
@section('head')
    <link rel="stylesheet" href="css/index.css"> 
@endsection 
@section('content')
@if(isset($success))
    <style>
        .toast{
            background-color: #4db6ac;
        }   
    </style>
    <script type="text/javascript">
        M.toast({html: '{{$success}}'})
    </script>
@endif
<div class="row">
    <div class="col s8">
    </div>
    <div class="col s4" id="up">
        <div id="login" class="card darken-1">
            <div class="row">
                <div class="col s12 teal lighten-2 white-text" id="top">
                    <h4 class="center-align">
                        <img src="img/paw-print-.png" alt="StarPets">
                        <br>Iniciar sesion</h4>
                </div>
                <form class="col s12" method="POST" action="Cliente/login">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mail_outline</i>
                        <input id="mail" name="mail" type="text" class="validate">
                        <label for="mail">E-Mail</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="clave" name="clave" type="password" class="validate">
                        <label for="clave">Password</label>
                    </div>
                    <div class="col s4"></div>
                    <div class="col s4">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Entrar</button>
                    </div>
                    <div class="col s4"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection