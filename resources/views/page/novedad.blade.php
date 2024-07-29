@extends('layouts.app')
@section('title', $novedad->titulo)
@section('content')
<div class="bg__breadcrumb">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >{{$novedad->titulo}}</li>

            </ol>
            <span class="breadcrumb-titulo">{{$novedad->titulo}}</span>
          </nav>
    </div>
</div>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <img src="{{ asset(Storage::url($novedad->imagen)) }}" class="w-100" style="height: 400px">
            <p class="card-text">{{ $novedad->categoria->titulo }}</p>
            <h5 class="card-title">{{ $novedad->titulo }}</h5>
            <p class="card-text-corto">{!! $novedad->descripcion !!}</p>
        </div>
    </div>
</div>











@endsection