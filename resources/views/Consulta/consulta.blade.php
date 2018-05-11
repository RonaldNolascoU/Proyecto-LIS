@extends('layouts.user') 

@section('title','Consulta') 

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xl12">
                <div class="row">
                    <div class="col xl12">
                        <h4 class="teal-text center-align">Consulta</h4>
                    </div>
                    <div class="col xl3 offset-xl9 right-align">
                        <button class="btn waves-effect waves-light blue" id="recargar" type="button" name="action">Recargar
                            <i class="material-icons right">autorenew</i>
                        </button>
                    </div>
                    <div class="col xl12" id="info">
                        <div class="row">
                            <input type="hidden" name="vet" id="vet" value="{{Auth::user()->id}}" readonly>
                            <input type="hidden" name="id" id="id" readonly>
                            <div class="col xl3">
                                <div class="row">
                                    <div class="col xl12">
                                        <div class="card">
                                            <div class="card-image">
                                                <img id="mascota">
                                                <span class="card-title" id="nombre"></span>
                                            </div>
                                            <div class="card-content">
                                                <p><b>Edad: </b><span id="edad"></span> años</p>
                                                <p><b>Tipo: </b><span id="tipo"></span></p>
                                                <p><b>Peso: </b><span id="peso"></span> libras</p>
                                                <p><b>Altura: </b><span id="altura"></span> cm</p>
                                            </div>
                                            <div class="card-action">
                                                <p><b>Dueño: </b><span id="cliente"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col xl12 center-align">
                                        <button class="btn waves-effect waves-light blue" id="finalizar" type="button" name="action">Finalizar
                                            <i class="material-icons right">check</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col xl9">
                                <div class="row">
                                    <div class="col xl3 offset-xl9">
                                        <p class="right-align"><b id="fecha"></b></p>
                                    </div>
                                    <div class="col xl11 offset-xl1">
                                        <div class="row">
                                            <div class="col xl12">
                                                <div class="col xl6">
                                                    <h6 class="teal-text">Agregar sintomas</h6>
                                                    <div class="input-field col xl12">
                                                        <i class="material-icons prefix">announcement</i>
                                                        <input id="Sintoma" name="Sintoma" type="text" class="validate">
                                                        <label for="Sintoma">Sintoma</label>
                                                    </div>
                                                    <div class="col xl8 offset-xl2">
                                                        <button class="btn waves-effect waves-light blue" id="ingresarSintoma" type="button" name="action">Agregar
                                                            <i class="material-icons right">add</i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col xl6">
                                                    <ul class="collection with-header" id="listaSintomas">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col xl12">
                                                <div class="col xl6">
                                                    <h6 class="teal-text">Agregar servicio brindado</h6>
                                                    <div class="input-field col xl12">
                                                        <i class="material-icons prefix">announcement</i>
                                                        <input id="Servicio" name="Servicio" type="text" class="validate">
                                                        <label for="Servicio">Servicio</label>
                                                    </div>
                                                    <div class="input-field col xl12">
                                                            <i class="material-icons prefix">monetization_on</i>
                                                            <input id="Precio" name="Precio" type="text" class="validate">
                                                            <label for="Precio">Precio</label>
                                                        </div>
                                                    <div class="col xl8 offset-xl2">
                                                        <button class="btn waves-effect waves-light blue" id="ingresarServicio" type="button" name="action">Agregar
                                                            <i class="material-icons right">add</i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col xl6">
                                                    <ul class="collection with-header" id="listaServicios">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col xl12">
                                                <div class="col xl6 offset-xl3">
                                                    <h6 class="teal-text">Agregar Diagnostico</h6>
                                                    <div class="input-field col xl12">
                                                        <i class="material-icons prefix">local_hospital</i>
                                                        <input id="Diagnostico" name="Diagnostico" type="text" class="validate">
                                                        <label for="Diagnostico">Diagnostico</label>
                                                    </div>
                                                    <div class="col xl8 offset-xl2">
                                                        <button class="btn waves-effect waves-light blue" id="ingresarDiagnostico" type="button" name="action">Agregar
                                                            <i class="material-icons right">add</i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col xl12">
                                                    <h6 class="teal-text">Diagnosticos</h6>
                                                    <div class="row" id="diagnosticos">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col xl12" id="error">
                        <h1 class="center-align">No tiene consultas por atender</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal8" class="modal">
        <div class="modal-content">
            <h4 class="teal-text">Ingresar medicamento</h4>
            <div class="container">
                <form>
                    {{ csrf_field() }}
                    <div class="row">
                        <input type="hidden" name="id" id="diagnostico_id" value="">
                        <div class="input-field col xl12">
                            <i class="material-icons prefix">details</i>
                            <select name="Tipo" id="Tipo">
                                <option value="0" disabled selected>Choose your option</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->TipoMedicamento}}</option>
                                @endforeach
                            </select>
                            <label>Tipo de medicamento</label>
                        </div>
                        <div class="input-field col xl12">
                            <i class="material-icons prefix">local_pharmacy</i>
                            <input id="NombreMedicamento" name="NombreMedicamento" type="text" class="validate">
                            <label for="NombreMedicamento">Medicamento</label>
                        </div>
                        <div class="input-field col xl12">
                            <i class="material-icons prefix">queue</i>
                            <input id="Medida" name="Medida" type="text" class="validate">
                            <label for="Medida">Medida</label>
                        </div>    
                        <div class="col xl12 center-align">
                            <button type="button" id="ingresarMedicamento" class="btn waves-effect waves-light white-text" name="action">
                                Ingresar
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" id="cancelar" class="modal-close waves-effect waves-green btn-flat option">cancelar</a>
        </div>
    </div>
    <script type="text/javascript" src='../../js/consulta.js'></script>
@endsection