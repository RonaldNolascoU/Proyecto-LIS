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
                        <h1>No tiene consultas por atender</h1>
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
            <a href="#!" class="modal-close waves-effect waves-green btn-flat option">cancelar</a>
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
        
        function llenar() {
            var vet = $('#vet').val();
            $.ajax({
                type: 'POST',
                url: '/conseguirConsulta',
                data: { id: vet },
                success: function (consulta) {
                    if(consulta != ""){
                        var actual = new Date();
                        var nac = new Date(consulta.FechaNacimiento);
                        var dif = actual - nac;
                        $('#id').val(consulta.id);
                        $('#mascota').attr('src', '../img/Mascotas/' + consulta.imagen);
                        $('#nombre').text(consulta.NombreMascota);
                        $('#edad').text(Math.round(dif / (1000 * 60 * 60 * 24 * 365)));
                        $('#tipo').text(consulta.NombreTipo);
                        $('#peso').text(consulta.Peso);
                        $('#altura').text(consulta.Altura);
                        cliente(consulta.cliente_id);
                        $('#fecha').text(actual.toLocaleDateString() + ', ' + consulta.HoraLlegada);
                        llenarSintomas();
                        llenarDiagnostico();
                        $('#info').show();
                        $('#error').hide();
                    }else{
                        $('#id').val("");
                        $('#info').hide();
                        $('#error').show();
                    }
                },
                error: function () {
                    $('#id').val("");
                    $('#info').hide();
                    $('#error').show();
                }
            });
        }
        
        function llenarSintomas(){
            var id = $('#id').val();
            $('#listaSintomas').empty();
            $.ajax({
                type: 'POST',
                url: '/llenarSintomas',
                data: {id: id},
                success: function (sintomas) {
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
        }
        
        function llenarDiagnostico(){
            var id = $('#id').val();
            $('#diagnosticos').empty();
            $.ajax({
                type: 'POST',
                url: '/llenarDiagnosticos',
                data: {id: id},
                success: function (diagnosticos) {
                    var tabs = 0;
                    diagnosticos.Diagnosticos.forEach(function(valor,indice){
                        var card = '<div class="col xl6"><div class="card"><div class="card-image teal white-text center-align"><i class="material-icons large">local_hospital</i><a valid="' + valor.id + '" class="btn-floating halfway-fab waves-effect waves-light red eliminarDiagnostico"><i class="material-icons">remove</i></a></div><div class="card-content"><p id="diagnostico">' + valor.DescripcionDiagnostico + '</p></div><div class="card-tabs"><ul class="tabs tabs-fixed-width teal-text">';
                        diagnosticos.Medicamentos[indice].forEach(function(medicamento,i){
                            card += '<li class="tab"><a href="#medicamento'+ medicamento.id +'">Medicamento</a></li>';
                            tabs++;
                        })
                        card += '</ul></div><div class="card-content grey lighten-4">';
                        diagnosticos.Medicamentos[indice].forEach(function(medicamento,i){
                            card += '<div id="medicamento' + medicamento.id + '">' + medicamento.NombreMedicamento + ', ' + medicamento.Medida + '<div><a valid="' + medicamento.id + '" class="btn-floating waves-effect waves-light red btn-small eliminarMedicamento secondary-content"><i class="material-icons tiny">close</i></a></div></div>';
                        });
                        card += '</div><div class="card-action"><a id="mostrarModal" valid="' + valor.id + '" class="modal-trigger" href="#modal8">Ingresar medicamento</a></div></div></div>'
                        $('#diagnosticos').append(card);
                    });
                    if(tabs != 0){
                        $('.tabs').tabs();
                    }
                },
                error: function(){
                }
            })
        }

        function verificar(){
            var id = $('#id').val();
            if(id == ""){
                console.log('si2')
                llenar();
            }
        }

        $(document).ready(function(){
            llenar();
            window.setInterval(verificar,1000);
            $(document).on('click','#recargar',function(){
                console.log('si')
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
                            llenarSintomas();
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
                var consulta_id = $('#id').val();
                var id = this.getAttribute('valid');
                if(confirm('Seguro desea eliminar este sintoma')){
                    $.ajax({
                        type: 'POST',
                        url: '../../Sintoma/'+id,
                        data: { _method: 'DELETE', consulta_id: consulta_id },
                        success: function (sintomas) {
                            llenarSintomas();
                        },
                        error: function () {
                            
                        }
                    })
                }
            })
            
            $(document).on('click','#ingresarDiagnostico',function(){
                var id = $('#id').val();
                var diagnostico = $('#Diagnostico').val();
                diagnostico = diagnostico.trim();
                if(diagnostico != ""){
                    $.ajax({
                        type: 'POST',
                        url: '../../Diagnostico',
                        data: { id: id, diagnostico: diagnostico },
                        success: function (diagnosticos) {
                            console.log(diagnosticos);
                            llenarDiagnostico();
                        },
                        error: function(){

                        }
                    })
                }else{
                    M.toast({html: "El campo de diagnosticos debe estar lleno"});
                }
                $('#Diagnostico').val("");
                $('#Diagnostico').focus();
            })
            
            $(document).on('click','.eliminarDiagnostico', function(){
                var consulta_id = $('#id').val();
                var id = this.getAttribute('valid');
                if(confirm('Seguro desea eliminar este diagnostico')){
                    $.ajax({
                        type: 'POST',
                        url: '../../Diagnostico/'+id,
                        data: { _method: 'DELETE', consulta_id: consulta_id },
                        success: function (sintomas) {
                            llenarDiagnostico();
                        },
                        error: function () {
                            
                        }
                    })
                }
            })
            
            $(document).on('click','#mostrarModal', function(){
                var id = this.getAttribute('valid');
                $('#diagnostico_id').val(id);
            });

            $(document).on('click','#ingresarMedicamento',function(){
                var id = $('#diagnostico_id').val();
                var tipo = $('#Tipo').val();
                var nombre = $('#NombreMedicamento').val();
                var medida = $('#Medida').val();
                nombre = nombre.trim();
                medida = medida.trim();
                if(nombre == "" && medida == ""){
                    M.toast({html: "Todos los campos deben estar llenos"})
                    $('#NombreMedicamento').val("");
                    $('#Medida').val("");
                    $('#NombreMedicamento').focus();
                }else{
                    $.ajax({
                        type: 'POST',
                        url: '../../Medicamento',
                        data: { id: id, tipo: tipo, nombre: nombre, medida: medida },
                        success: function (respuesta) {
                            $('#modal8').modal('close');
                            llenarDiagnostico();
                        },
                        error: function(){

                        }
                    })
                }
            });
            
            $(document).on('click','.eliminarMedicamento', function(){
                var id = this.getAttribute('valid');
                if(confirm('Seguro desea eliminar este medicamento')){
                    $.ajax({
                        type: 'POST',
                        url: '../../Medicamento/'+id,
                        data: { _method: 'DELETE' },
                        success: function (respuesta) {
                            llenarDiagnostico();
                        },
                        error: function () {
                            
                        }
                    })
                }
            })
            
        });
    </script>
@endsection