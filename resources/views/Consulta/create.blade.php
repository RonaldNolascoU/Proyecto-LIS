@extends('layouts.user') 

@section('title','Ingresar consulta') 

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
                                <h4>Registrar consulta</h4>
                            </div>
                            <form class="col xl12" id="frmConsulta" action="{{route('Consulta.store')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="Cliente" name="Cliente" type="text" class="validate" >
                                    <label for="Cliente">Cliente - correo</label>
                                </div>
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">details</i>
                                    <select name="Mascota" id="Mascota">
                                        <option value="" disabled selected>Choose your option</option>
                                    </select>
                                    <label>Mascotas</label>
                                </div>
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">details</i>
                                    <select name="Veterinario" id="Veterinario">
                                        <option value="" disabled selected>Choose your option</option>
                                        @foreach($vets as $vet)
                                            <option value="{{$vet->id}}">{{$vet->name}}</option>
                                        @endforeach
                                    </select>
                                    <label>Veterinario</label>
                                </div>
                                <div class="input-field col xl6 offset-xl3 input-validado">
                                    <i class="material-icons prefix">fitness_center</i>
                                    <input id="Peso" name="Peso" type="text" class="validate" >
                                    <label for="Peso">Peso en libras</label>
                                    <span class="error Peso"></span>
                                </div>
                                <div class="input-field col xl6 offset-xl3 input-validado">
                                    <i class="material-icons prefix">vertical_align_top</i>
                                    <input id="Altura" name="Altura" type="text" class="validate" >
                                    <label for="Altura">Altura en centimetros</label>
                                    <span class="error Altura"></span>
                                </div>
                                <div class="col xl4 offset-xl8 s5 offset-s3">
                                    <button class="btn waves-effect waves-light" id="btnConsulta" type="button" name="action">Ingresar
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
    <script type="text/javascript" src="../../js/correo.js"></script>
    <script type="text/javascript">
        function validarNumero(cadena,nombre){
            if($.isNumeric(cadena)){
                $("."+nombre).text('');
                $("#"+nombre).removeClass("invalid");
                $("#"+nombre).addClass("valid");
                return true;
            }else{
                $("."+nombre).text('Ingrese un numero valido');
                $("#"+nombre).removeClass("valid");
                $("#"+nombre).addClass("invalid");
                return false;
            }
        }

        var peso = false;
        var altura = false;

         $(document).ready(function(){
            $(document).on('focus keyup blur','#Peso',function(){
                var cadena = $('#Peso').val();
                var nombre = this.getAttribute('id');
                peso = validarNumero(cadena,nombre);
            })

            $(document).on('focus keyup blur','#Altura',function(){
                var cadena = $('#Altura').val();
                var nombre = this.getAttribute('id');
                altura = validarNumero(cadena,nombre);
            })

            $(document).on('click','#btnConsulta', function(){
                if(peso && altura){
                    $('#frmConsulta').submit();
                }else{
                    swal("Error", "Revise lo ingresado", "error");
                }
            })
         })
    </script>
@endsection