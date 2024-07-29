@extends('layouts.app')
@section('title', 'Piezas a medidas')
@section('content')
<div class="bg__breadcrumb w-100">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Piezas a medidas</li>

            </ol>
            <span class="breadcrumb-titulo">Piezas a medidas</span>
          </nav>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <div style="background-image: url('{{ asset(Storage::url($piezas->imagen)) }}');
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                        height: 500px;">
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="contenido__titulo">{{$piezas->titulo}}</h3>
            <div class="contenido__descripcion mt-3 custom-list">
                {!! $piezas->descripcion !!}
            </div>
            {{-- <a type="button" href="" class="btn btn__azul mb-2 px-5" >MÁS INFORMACIÓN</a> --}}
        </div>
        
    </div>
</div>

<div class="container">
    <div class="row">
        <h3 class="contenido__titulo">Trabajos realizados</h3>
    </div>

    <div class="row mt-4">
        @foreach (json_decode($piezas->imagen_galeria, true)  as $imagen)
        <div class="col-6 col-md-3 mb-4">
            <img src="{{ asset(Storage::url($imagen)) }}" class="w-100" alt="Imagen">
        </div>
        @endforeach
    </div>
</div>


@endsection