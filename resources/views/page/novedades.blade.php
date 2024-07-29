@extends('layouts.app')
@section('title', 'Novedades')
@section('content')

<div class="bg__breadcrumb">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Novedades</li>
            </ol>
            <span class="breadcrumb-titulo">Novedades</span>
          </nav>
    </div>
</div>



<div class="container my-5">
    <div class="row">
        @foreach ($novedades as $novedad)
        <div class="col-md-4 mb-4">
            <div class="card border-0 rounded-0">
                <a href="{{route('novedad', $novedad->id)}}">
                    <img src="{{ asset(Storage::url($novedad->imagen)) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{ $novedad->categoria->titulo }}</p>
                        <h5 class="card-title">{{ $novedad->titulo }}</h5>
                        <p class="card-text-corto">{!! Str::limit($novedad->descripcion, 40, '...') !!}</p>
                    </div>
                    <div class="card-overlay"></div> <!-- Capa overlay para el efecto hover -->
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection