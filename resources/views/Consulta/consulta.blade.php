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
                                        <div class="row">
                                            <div class="col xl12">
                                                <h6 class="teal-text">Diagnostico</h6>
                                                <div class="col xl12">
                                                    <div class="row">
                                                        <div class="col xl6">
                                                            <div class="card">
                                                                <div class="card-image teal white-text center-align">
                                                                    <i class="material-icons large">gps_not_fixed</i>
                                                                </div>
                                                                <div class="card-content">
                                                                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                                                                </div>
                                                                <div class="card-tabs">
                                                                    <ul class="tabs tabs-fixed-width">
                                                                        <li class="tab"><a href="#test4">Test 1</a></li>
                                                                        <li class="tab"><a class="active" href="#test5">Test 2</a></li>
                                                                        <li class="tab"><a href="#test6">Test 3</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-content grey lighten-4">
                                                                    <div id="test4">Test 1</div>
                                                                    <div id="test5">Test 2</div>
                                                                    <div id="test6">Test 3</div>
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
                var id = $('#id').val();
                var sintoma = $('#Sintoma').val();
                sintoma = sintoma.trim();
                if(sintoma != ""){
                    $('#listaSintomas').empty();
                    $.ajax({
                        type: 'POST',
                        url: '../../Sintoma',
                        data: { id: id, sintoma: sintoma },
                        success: function (sintomas) {
                            console.log(sintomas)
                            $('#listaSintomas').append('<li class="collection-header teal-text"><h6 class="center-align">Sintomas</h6></li>');
                            sintomas.forEach(function(valor,indice){
                                $('#listaSintomas').append('<li class="c-item"><div class="valor-li"><span>'+ valor.DescripcionSintoma +'</span></div><div valid="' + valor.id + '" class="btn-li eliminarSintoma"><a class="btn-floating waves-effect waves-light red btn-small"><i class="material-icons tiny">remove</i></a></div></li>');
                            });
                            $('#Sintoma').val("");
                            $('#Sintoma').focus();
                        },
                        error: function(){

                        }
                    })
                }else{
                    M.toast({html: "El campo de sintomas debe estar lleno"})
                    $('#Sintoma').val("");
                    $('#Sintoma').focus();
                }
            });
            $(document).on('click','.eliminarSintoma', function(){
                var id = $('#id').val();
                var id = this.getAttribute('valid');
                if(confirm('Seguro desea eliminar este sintoma')){
                    $.ajax({
                        type: 'POST',
                        url: '../../Sintoma/'+id,
                        data: { _method: 'DELETE', consulta_id: id },
                        success: function (sintomas) {
                            console.log(sintomas)
                            $('#listaSintomas').empty();
                            $('#listaSintomas').append('<li class="collection-header teal-text"><h6 class="center-align">Sintomas</h6></li>');
                            sintomas.forEach(function(valor,indice){
                                $('#listaSintomas').append('<li class="c-item"><div class="valor-li"><span>'+ valor.DescripcionSintoma +'</span></div><div valid="' + valor.id + '" class="btn-li eliminarSintoma"><a class="btn-floating waves-effect waves-light red btn-small"><i class="material-icons">remove</i></a></div></li>');
                            });
                            $('#Sintoma').val("");
                            $('#Sintoma').focus();
                        },
                        error: function () {
                            
                        }
                    })
                }
            })
        });
    </script>
@endsection