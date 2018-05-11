@extends('layouts.user') 

@section('title','Ingresar tipo de medicamento') 

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
                                <h4>Registrar tipo de medicamento</h4>
                            </div>
                            <form id="frmTipo" class="col xl12" action="{{route('TipoMedicamento.store')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">local_hospital</i>
                                    <input id="Nombre" name="Nombre" type="text" class="validate" required>
                                    <label for="Nombre">Nombre</label>
                                    <span class="error Nombre"></span>
                                </div>
                                <div class="col xl4 offset-xl8 s5 offset-s3">
                                    <button class="btn waves-effect waves-light" id="btnTipo" type="button" name="action">Registrar
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
    <script type="text/javascript" src="../../js/validarTipo.js"></script>
@endsection