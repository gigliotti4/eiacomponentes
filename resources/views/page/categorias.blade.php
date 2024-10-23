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
      <!-- Sidebar de Categorías -->
    <div class="col-md-3">
            <form action="{{ route('productos.search') }}" method="GET" class="mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Buscar producto..." value="{{ request()->input('search') }}">
                </form>
      <!-- Categorías -->
        <ul class="list-group border mb-4">
          <h4 class="p-3 border-bottom titulo__producto">Categorías</h4>
          @foreach($categorias as $categoria)
              <li class="list-group-item border-0">
                  <a href="{{ route('filtroproducto', ['categoria_id' => $categoria->id]) }}" 
                    class="list-menu @if(request('categoria_id') == $categoria->id) active__header @endif">
                      {{ $categoria->nombre }}
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
                    <a href="{{ route('producto', $producto->id) }}" class="card mb-4">
                        <img src="{{ asset(Storage::url($producto->imagen)) }}" class="card-img-top imagen" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                @if($producto->categorias->isNotEmpty())
                                    <div class="card-subtitulo">
                                        @foreach ($producto->categorias as $categoria)
                                            <span>{{ $categoria->nombre }}</span>@if(!$loop->last), @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="card-subtitulo">Sin categoría</div>
                                @endif
                                <div class="card-codigo">COD.{{ $producto->codigo }}</div>
                            </div>
                            <h5 class="card-titulo">{{ $producto->nombre }}</h5>
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
