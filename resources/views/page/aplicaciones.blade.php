@extends('layouts.app')
@section('title', 'Cintas transportadoras')
@section('content')

<div class="bg__breadcrumb">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Cintas transportadoras</li>

            </ol>
            <span class="breadcrumb-titulo">Cintas transportadoras</span>
          </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <div style="background-image: url('{{ asset(Storage::url($cintas->imagen)) }}');
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                        height: 500px;">
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="contenido__titulo">{{$cintas->titulo}}</h3>
            <div class="contenido__descripcion mt-3 custom-list">
                {!! $cintas->descripcion !!}
            </div>
            {{-- <a type="button" href="" class="btn btn__azul mb-2 px-5" >MÁS INFORMACIÓN</a> --}}
        </div>
        
    </div>
</div>


<div class="container my-5">
  <div class="row">´
    <h5 class="breadcrumb-titulo">ÁREAS DE APLICACIÓN</h5>
      @foreach ($aplicaciones as $item)
          <div class="col-md-12 mb-4">
              <h5 class="mb-3 aplicaciones-titulo">{{ $item->titulo }}</h5>
              <div class="d-flex flex-wrap">
                  @foreach (json_decode($item->galeria, true) as $key => $imagen)
                      <div class="image-container position-relative mr-2 mb-2" id="image-{{ $key }}">
                          <img src="{{ asset(Storage::url($imagen)) }}" alt="" class="gallery-image">
                      </div>
                  @endforeach
              </div>
          </div>
      @endforeach
  </div>
</div>


@endsection