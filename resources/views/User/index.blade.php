@extends('layouts.user') 

@section('title','Lista de usurios') 

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <link rel="stylesheet" href="../../css/jPages.css">
    <script type="text/javascript" src="../../js/jpage.js"></script>
    <div class="container">
        <div class="col xl12">
            <div class="row">
                <div class="col xl12">
                    <h4 class="center-align teal-text">Lista de usuarios</h4>
                </div>
                <div class="col xl12">
                    <div class="row">
                        <a href="{{route('User.create')}}" class="waves-effect waves-light btn blue"><i class="material-icons right">add</i>Nuevo usuario</a>
                    </div>
                </div>
                <div class="col xl12">
                    <div class="row">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Nivel de acceso</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="usuarios">
                                @foreach($users as $user)
                                    @if($user->id != Auth::user()->id)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roles->first()->Name}}</td>
                                            <td>
                                                @if($user->roles->first()->Name != 'Administrado')
                                                    @if($user->estado != 2)
                                                        <button class="btn waves-effect waves-light red" id="degradar" valid="{{$user->id}}" type="button" name="action">Degradar
                                                            <i class="material-icons right">file_download</i>
                                                        </button>
                                                        <form id="{{$user->id}}" method="POST" action="{{ route('User.update',$user->id) }}" role="form">
                                                            {{ csrf_field() }}
                                                            <input name="_method" type="hidden" value="PATCH">
                                                        </form>
                                                    @else
                                                        Usuario degradado
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="holder controladorUsuarios"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/user.js"></script>
@endsection