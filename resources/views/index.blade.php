@extends('layouts.login')

@section('title','Index')

@section('head')
    <link rel="stylesheet" href="css/index.css">
@endsection

@section('content')
    <div class="row">
        <div class="col s8">
        </div>
        <div class="col s4" id="up">
        <div id="login" class="card darken-1">
            <div class="row">
            <div class="col s12 teal lighten-2 white-text" id="top">
                <h4 class="center-align"><img src="img/paw-print-.png" alt=""><br>Iniciar sesion</h4>
            </div>
            <form class="col s12" method="POST" action="login">
                <div class="input-field col s12">
                <i class="material-icons prefix">mail_outline</i>
                <input id="mail" type="text" class="validate">
                <label for="mail">E-Mail</label>
                </div>
                <div class="input-field col s12">
                <i class="material-icons prefix">lock_outline</i>
                <input id="clave" type="password" class="validate">
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