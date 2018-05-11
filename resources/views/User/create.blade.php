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
                                <h4>Registrar usuario</h4>
                            </div>
                            <form id="frmUser" class="col xl12" action="{{route('User.store')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-field col xl6 offset-xl3 input-validado">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="Nombre" name="Nombre" type="text" class="validate" >
                                    <label for="Nombre">Nombre</label>
                                    <span class="error Nombre"></span>
                                </div>
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">mail_outline</i>
                                    <input id="Correo" name="Correo" type="email" class="validate" >
                                    <label for="Correo">Correo</label>
                                    <span class="error Correo"></span>
                                </div>
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">details</i>
                                    <select name="Tipo" id="Tipo">
                                        <option value="" disabled selected>Choose your option</option>
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->id}}">{{$rol->Name}}</option>
                                        @endforeach
                                    </select>
                                    <label>Nivel de acceso</label>
                                </div>
                                <div class="col xl4 offset-xl8 s5 offset-s3">
                                    <button class="btn waves-effect waves-light" id="btnUser" type="button" name="action">Registrar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                                <div class="col xl12">
                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/validacion.js"></script>
    <script type="text/javascript" src="../../js/validarUser.js"></script>
@endsection