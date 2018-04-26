@extends('layouts.user') 

@section('title','Ingresar consulta') 

@section('head')
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
                            <form class="col xl12" action="{{route('Consulta.store')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="Cliente" name="Cliente" type="text" class="validate">
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
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">fitness_center</i>
                                    <input id="Peso" name="Peso" type="text" class="validate">
                                    <label for="Peso">Peso</label>
                                </div>
                                <div class="input-field col xl6 offset-xl3">
                                    <i class="material-icons prefix">vertical_align_top</i>
                                    <input id="Altura" name="Altura" type="text" class="validate">
                                    <label for="Altura">Altura</label>
                                </div>
                                <div class="col xl4 offset-xl8 s5 offset-s3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Ingresar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#Cliente').keyup(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/clienteMascota',
                    data: {correo: $('#Cliente').val(), _token: '{{csrf_token()}}'},
                    success: function(mascotas){
                        $('#Mascota').empty();
                        mascotas.forEach(function(valor,indice){
                            $('#Mascota').append(new Option(valor.NombreMascota, valor.id, true, true));
                        });
                    },
                    error: function(){
                        $('#Mascota').empty();
                        $('#Mascota').append('<option value="" disabled selected>Choose your option</option>');
                    }
                });
            });
        });
    </script>
@endsection