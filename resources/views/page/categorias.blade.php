@extends('layouts.app')
@section('title', 'Productos')
@section('content')
<div class="bg__breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <strong class="breadcrumb-item">Productos</strong>
            </ol>
          </nav>
    </div>
</div> 
<div class="container my-5">
    <div class="row">
        <!-- Sidebar de Categorías y Colores -->
        <div class="col-md-3">
            <ul class=" list-group border mb-4">
                <h4 class="p-3 border-bottom titulo__producto">Categorías</h4>
                @foreach($categorias as $categoria)
                    <li class="list-group-item border-0">
                        <a href="{{ route('filtroproducto', ['categoria_id' => $categoria->id]) }}" class="list-menu">
                            {{ $categoria->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <ul class=" list-group border">
                <h4 class="p-3 border-bottom titulo__producto">Colores</h4>
                @foreach($colores as $color)
                    <li class="list-group-item border-0 d-flex align-items-center">
                        <span class="color-box border" style="background-color: {{ $color->color }}; width: 20px; height: 20px; display: inline-block; margin-right: 10px;"></span>
                        <a href="{{ route('filtroproducto', ['categoria_id' => request('categoria_id'), 'color_id' => $color->id]) }}" class="list-menu">
                            {{ $color->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
           
            @if ($productos->isEmpty())
              <p>No hay productos disponibles.</p>
            @else
              <div class="row">
                @foreach ($productos as $producto)
                  <div class="col-6 col-md-4">
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
    
</div>


@endsection
