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
                    <div class="col xl12">
                        <div class="row">
                            <input type="hidden" name="vet" id="vet" value="{{Auth::user()->id}}">
                            <input type="hidden" name="id" id="id">
                            <div class="col xl3">
                                <div class="row">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function cliente(id){
            $.ajax({
                type: 'POST',
                url: '/conseguirCliente',
                data: { id: id },
                success: function (cliente) {
                    $('#cliente').text(cliente.PrimerNombre + " " + cliente.PrimerApellido)
                },
                error: function () {
                    
                }
            });
        }
        function verificar(){
            var vet = $('#vet').val();
            var id = $('#id').val();
            //if(id == ""){
                $.ajax({
                    type: 'POST',
                    url: '/conseguirConsulta',
                    data: { id: vet },
                    success: function (consulta) {
                        console.log(consulta);
                        var actual = new Date();
                        var nac = new Date(consulta.FechaNacimiento);
                        var dif = actual - nac;
                        $('#id').val(consulta.id);
                        $('#mascota').attr('src','../img/Mascotas/'+consulta.imagen);
                        $('#nombre').text(consulta.NombreMascota);
                        $('#edad').text(Math.round(dif/(1000*60*60*24*365)));
                        $('#tipo').text(consulta.NombreTipo);
                        $('#peso').text(consulta.Peso);
                        $('#altura').text(consulta.Altura);
                        cliente(consulta.cliente_id);
                        $('#fecha').text(actual.toLocaleDateString()+', '+consulta.HoraLlegada);
                    },
                    error: function () {
                        $('#id').val("");
                    }
                });
            //}
        }

        $(document).ready(function(){
            verificar()
            //window.setInterval(verificar,1000);
            $(document).on('click','#recargar',function(){
                verificar();
            });
            $(document).on('click','#ingresarSintoma',function(){
                var sintoma = $('#Sintoma').val();
                if(sintoma != ""){
                    $('#listaSintomas').empty();
                    $('#listaSintomas').append('<li class="collection-header teal-text"><h6 class="center-align">Sintomas</h6></li>')
                }
            });
        });
    </script>
@endsection