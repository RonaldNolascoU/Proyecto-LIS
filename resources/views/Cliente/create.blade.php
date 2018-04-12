@extends('layouts.login')

@section('title','Index')

@section('head')
    <link rel="stylesheet" href="../css/index.css">
@endsection

@section('content')
    <div class="row">
        <div class="col s4"></div>
        <div class="col s4" id="reg">
            <div class="row">
                <form action="Cliente" method="POST">
                    
                </form>
            </div>
        </div>
    </div>
@endsection