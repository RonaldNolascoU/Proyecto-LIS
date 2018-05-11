@extends('layouts.user') 

@section('title','Lista de consultas') 

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row">
        <div class="col xl9">
            <div class="col xl12">
                <div class="row">
                    <div class="col xl3 offset-xl9">
                        <div class="row">
                            <br>
                            <button class="btn waves-effect waves-light blue" id="recargar" type="button" name="action">Recargar
                                <i class="material-icons right">autorenew</i>
                            </button>
                        </div>
                    </div>
                    <div class="col xl12">
                        <div class="row">
                            <div class="col xl12">
                                <h4 class="center-align teal-text">Consultas entrantes</h4>
                            </div>
                            <div class="col xl10 offset-xl1">
                                <table id="entrantes" class="highlight centered">
                                </table>
                                <div class="holder controladorEntrantes"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col xl12">
                        <div class="row">
                            <div class="col xl12">
                                <h4 class="center-align teal-text">Consultas por pagar</h4>
                            </div>
                            <div class="col xl10 offset-xl1">
                                <table id="pago" class="highlight">    
                                </table>
                                <div class="holder controladorPago"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col xl3">
            <ul class="collection with-header" id="listaLibres">
            </ul>
        </div>
    </div>
    <div id="modal6" class="modal">
        <div class="modal-content">
            <h4 class="teal-text">Detalles de consulta</h4>
            <div class="container">
                <div class="row">
                    <div class="col xl12">
                        <span id="DetalleNombre"></span>
                    </div>
                    <div class="col xl12">
                        <span id="DetalleFecha"></span>
                    </div>
                    <div class="col xl12">
                        <span id="DetalleVeterinario"></span>
                    </div>
                    <div class="col xl6">
                        <span id="DetallePeso"></span>
                    </div>
                    <div class="col xl6">
                        <span id="DetalleAltura"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat option">Cerrar</a>
        </div>
    </div>
    <div id="modal7" class="modal">
        <div class="modal-content">
            <h4 class="teal-text">Cambiar veterinario</h4>
            <div class="container">
                <form method="post" id="frmImagen" action="Cliente/imagen" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <input type="hidden" name="id" value="">
                        <div class="col xl12">
                            <span id="EditNombre"></span>
                        </div>
                        <div class="col xl12">
                            <span id="EditFecha"></span>
                        </div>
                        <div class="col xl6">
                            <span id="EditPeso"></span>
                        </div>
                        <div class="col xl6">
                            <span id="EditAltura"></span>
                        </div>
                        <div class="input-field col xl12">
                            <i class="material-icons prefix">details</i>
                            <select name="Veterinario" id="Veterinario">
                                <option value="0" disabled selected>Choose your option</option>
                                @foreach($vets as $vet)
                                <option value="{{$vet->id}}">{{$vet->name}}</option>
                                @endforeach
                            </select>
                            <label>Veterinario</label>
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
    <div id="modal9" class="modal">
        <div class="modal-content">
            <h4 class="teal-text">Detalles de pago</h4>
            <div class="container">
                <div class="row">
                    <input type="hidden" name="pago_id" id="pago_id">
                    <input type="hidden" name="consulta_costo" id="consulta_costo">
                    <div class="col xl12">
                        <span id="PagoNombre"></span>
                    </div>
                    <div class="col xl12">
                        <span id="PagoFecha"></span>
                    </div>
                    <div class="col xl12">
                        <span id="PagoVeterinario"></span>
                    </div>
                    <div class="col xl12">
                        <span id="Costo"></span>
                    </div>
                    <div class="col xl12 center-align">
                        <br>
                        <button class="btn waves-effect waves-light blue" id="btnPagar" type="button" name="action">Cancelar consulta
                            <i class="material-icons right">check</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat option">Cerrar</a>
        </div>
    </div>
    <link rel="stylesheet" href="../../css/jPages.css">
    <script type="text/javascript" src="../../js/jpage.js"></script>
    <script type="text/javascript" src='../../js/consultaSecretaria.js'></script>
@endsection