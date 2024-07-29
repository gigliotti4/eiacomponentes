@extends('layouts.app')
@section('title', 'Repuestos de cintas transportadoras')
@section('content')
<div class="bg__breadcrumb w-100">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Repuestos de cintas transportadoras</li>

            </ol>
            <span class="breadcrumb-titulo">Repuestos de cintas transportadoras</span>
          </nav>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <h3 class="contenido__titulo">{{$repuestos->titulo}}</h3>
            <div class="contenido__descripcion mt-3 custom-list">
                {!! $repuestos->descripcion !!}
            </div>
            {{-- <a type="button" href="" class="btn btn__azul mb-2 px-5" >MÁS INFORMACIÓN</a> --}}
        </div>
        <div class="col-md-6">
            <div style="background-image: url('{{ asset(Storage::url($repuestos->imagen)) }}');
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                        height: 500px;">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <h3 class="contenido__titulo">Galería de imágenes</h3>
    </div>

    <div class="row mt-4">
        @foreach (json_decode($repuestos->imagen_galeria, true)  as $imagen)
        <div class="col-6 col-md-3 mb-4">
            <img src="{{ asset(Storage::url($imagen)) }}" class="w-100" alt="Imagen">
        </div>
        @endforeach
    </div>
</div>


@endsection