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
                    <div class="col xl12">
                        <div class="row">
                            <div class="col xl12">
                                <h4 class="center-align teal-text">Consultas entrantes</h4>
                            </div>
                            <div class="col xl10 offset-xl1">
                                <table id="entrantes" class="highlight centered">
                                    <thead>
                                        <tr>
                                            <th>Mascota</th>
                                            <th>Veterinario</th>
                                            <th>Cambiar veterinario</th>
                                            <th>Detalles</th>
                                            <th>Eliminar</th>
                                            <th>Pasar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($consultasIngresadas->count()) @foreach($consultasIngresadas as $consulta)
                                        <tr class="info">
                                            <td>{{$consulta->mascota->NombreMascota}}</td>
                                            <td>
                                                {{$consulta->veterinario->name}}
                                            </td>
                                            <td>
                                                <a href="#modal7" valid="{{$consulta->id}}" id="edit" title="Cambiar veterinario" class="modal-trigger btn-floating blue">
                                                    <i class="material-icons">cached</i>
                                                </a>
                                            </td>
                                            <td>
                                                <a title="Detalles consulta" valid="{{$consulta->id}}" id="show" href="#modal6" class="modal-trigger btn-floating">
                                                    <i class="material-icons">dehaze</i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="modal-trigger btn-floating red" valid="{{$consulta->id}}" id="delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <form id="{{$consulta->id}}" action="{{ action('ConsultaController@destroy', $consulta->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                </form>
                                            </td>
                                            <td>
                                                <a title="Pasar consulta" valid="{{$consulta->id}}" id="next" class="btn-floating brown">
                                                    <i class="material-icons">navigate_next</i>
                                                </a>
                                                <form id="pasar{{$consulta->id}}" action="/pasar" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    <input name="id" type="hidden" value="{{$consulta->id}}">
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach @else
                                        <tr>
                                            <td colspan="6">No hay registros</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col xl6">
                        <div class="row">
                            <div class="col xl12">
                                <h4 class="center-align teal-text">Consultas por pagar</h4>
                            </div>
                            <div class="col xl10 offset-xl1">
                                <table class="highlight">
                                    <thead>
                                        <tr>
                                            <th>Mascota</th>
                                            <th>Veterinario</th>
                                            <th>Hora</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($consultasTerminadas->count()) @else
                                        <tr>
                                            <td colspan="5" class="center-align">No hay registros</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col xl3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h4>Veterinarios desocupados</h4>
                </li>
                <li class="collection-item">Kevin Romero</li>
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
    <script type="text/javascript" src="../../js/paginar.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function mascota(id){
            $.ajax({
                type: 'POST',
                url: '/conseguirMascota',
                data: { id: id },
                success: function (mascota) {
                    console.log(mascota)
                    document.getElementById('mascota'+id).innerHTML = mascota.NombreMascota;
                },
                error: function () {
                    document.getElementById('mascota'+id).innerHTML = 'Error';
                }
            });
        }
        function veterinario(id){
            $.ajax({
                type: 'POST',
                url: '/conseguirVeterinario',
                data: { id: id },
                success: function (user) {
                    console.log(user)
                    var clase = document.getElementsByClassName('veterinario'+id);
                    for(var i = 0; i<clase.length;i++){
                        clase[i].innerHTML = user.name
                    }
                },
                error: function () {
                    document.getElementsByClassName('#veterinario'+id).innerHTML = 'Error';
                }
            });
        }
        function llenar(){
            $('.info').remove();
            document.getElementById("entrantes").innerHTML = "<thead><tr><th>Mascota</th><th>Veterinario</th><th>Cambiar veterinario</th><th>Detalles</th><th>Eliminar</th></tr></thead><tbody>";
            $.ajax({
                type: 'POST',
                url: '/listaEntrantes',
                success: function (consultas) {
                    if(consultas.length){
                        consultas.forEach(function(valor,indice){    
                            $('#entrantes').append('<tr class="info"><td id="mascota'+ valor.mascota_id +'"></td><td class="veterinario'+ valor.user_id + '"></td><td><a href="#modal7" valid="'+ valor.id +'" id="edit" title="Cambiar veterinario" class="modal-trigger btn-floating blue"><i class="material-icons">cached</i></a></td><td><a title="Detalles consulta" valid="'+ valor.id +'" id="show" href="#modal6" class="modal-trigger btn-floating"><i class="material-icons">dehaze</i></a></td><td><a class="modal-trigger btn-floating red" valid="'+ valor.id +'" id="delete"><i class="material-icons">delete</i></a><form id="'+ valor.id +'" action="Consulta/'+ valor.id +'" method="POST" style="display: none;"><input type="hiden" name = " _token" value = "' + $('meta[name="csrf-token"]').attr('content') + '" ><input name="_method" type="hidden" value="DELETE"></form></td><td><a title="Pasar consulta" valid="' + valor.id + '" id="next" class="btn-floating brown"><i class="material-icons">navigate_next</i></a><form id="pasar' + valor.id + '" action="/pasar" method="POST" style="display: none;"><input type="hiden" name = " _token" value = "' + $('meta[name="csrf-token"]').attr('content') + '" ><input name="id" type="hidden" value="'+ valor.id +'"></form></td></tr>')
                            mascota(valor.mascota_id);
                            veterinario(valor.user_id)
                        });
                        document.getElementById("entrantes").innerHTML += "</tbody>"
                        $("#entrantes").paginationTdA({
                            elemPerPage: 5
                        });
                    }else{
                        $('#entrantes').append("<tr class='info'><td colspan='6' class='center-aling'>No hay registros</td></tr>");
                        document.getElementById("entrantes").innerHTML += "</tbody>"
                    }
                },
                error: function () {
                    $('#entrantes').append("<tr class='info'><td colspan='6' class='center-aling'>No hay registros</td></tr>");
                    document.getElementById("entrantes").innerHTML += "</tbody>"
                }
            });
        }
        $(document).ready(function(){
            window.setInterval(llenar, 50000);
            $("#entrantes").paginationTdA({
                elemPerPage: 5
            });
            $(document).on('click','#show', function(e){
                var id = this.getAttribute('valid')
                $.get("Consulta/"+id ,function(c){
                    document.getElementById("DetalleNombre").innerHTML = "<b>Nombre de la mascota: </b>"+c.mascota[0].NombreMascota;
                    document.getElementById("DetalleFecha").innerHTML = "<b>Fecha y hora: </b>"+c.consulta[0].FechaConsulta+", "+c.consulta[0].HoraLlegada;
                    document.getElementById("DetallePeso").innerHTML = "<b>Peso de la mascota: </b>"+c.consulta[0].Peso;
                    document.getElementById("DetalleAltura").innerHTML = "<b>Altura de la mascota: </b>"+c.consulta[0].Altura;
                    document.getElementById("DetalleVeterinario").innerHTML = "<b>Nombre del veterinario: </b>"+c.veterinario[0].name;
                });
            });
            $(document).on('click','#edit', function(e){
                var id = this.getAttribute('valid')
                $.get("Consulta/"+id+"/edit" ,function(c){
                    console.log(c)
                    document.getElementById("EditNombre").innerHTML = "<b>Nombre de la mascota: </b>"+c.mascota[0].NombreMascota;
                    document.getElementById("EditFecha").innerHTML = "<b>Fecha y hora: </b>"+c.consulta[0].FechaConsulta+", "+c.consulta[0].HoraLlegada;
                    document.getElementById("EditPeso").innerHTML = "<b>Peso de la mascota: </b>"+c.consulta[0].Peso;
                    document.getElementById("EditAltura").innerHTML = "<b>Altura de la mascota: </b>"+c.consulta[0].Altura;
                    $('#Veterianrio').find('option[value="'+ c.veterinario[0].id +'"]').prop('selected', true);
                    $('#Veterianrio').formSelect();
                });
            });
            $(document).on('click','#delete', function(e){
                var id = this.getAttribute('valid')
                if(confirm('Seguro desea borrar esta consulta')){
                    $('#'+id).submit();
                }
            })
            $(document).on('click','#next',function(){
                var id = this.getAttribute('valid')
                $('#pasar'+id).submit();
            })
        });
    </script>
@endsection