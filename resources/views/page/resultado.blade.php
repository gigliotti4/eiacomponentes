@extends('layouts.app')
@section('title', 'Productos')
@section('content')
<div class="bg__breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}" class="breadcrumb-item-menu">Inicio</a></li>
              <strong class="breadcrumb-item">Productos</strong>
            </ol>
          </nav>
    </div>
</div> 

<div class="container my-5">
    <div class="row">
    
            @if ($productos->isEmpty())
              <p>No hay productos disponibles.</p>
            @else
              <div class="row">
                @foreach ($productos as $producto)
                  <div class="col-6 col-md-3">
                    <a href="{{route('producto', $producto->id)}}" class="card mb-4">
                      <img src="{{ asset(Storage::url($producto->imagen)) }}" class="card-img-top imagen" alt="{{ $producto->nombre }}">
                      <div class="card-body">
                        {{-- <p>{{ $producto->colores->pluck('nombre')->implode(', ') }}</p> --}}
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitulo">{{ $producto->categoria->nombre }}</div>
                            <div class="card-codigo">COD.{{ $producto->codigo }}</div>
                        </div>
                        <h5 class="card-titulo">{{ $producto->nombre }}</h5>
                        {{-- <p class="card-text">{!! $producto->descripcion !!}</p> --}}
                         <p class="card-precio"> ${{ number_format($producto->precio, 2, ',', '.') }}</p>
                        <hr>
               
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            @endif

    </div>
</div> 


@endsection