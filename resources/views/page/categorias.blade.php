@extends('layouts.app')
@section('title', 'Productos')
@section('content')
<style>
    .titulo__producto{
        color: #000;

        /* Body/Bold/Body 16 */
        font-family: "Work Sans";
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: 150%;
    }

    .list-menu{
        color: #000;
    font-family: "Work Sans";
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; 
    }

    .list-menu:hover{
        color: #FE2324;
    font-family: "Work Sans";
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; 
    }
</style>
<div class="container my-5">
    <div class="row">
        <!-- Sidebar de Categorías y Colores -->
        <div class="col-md-3">
            <ul class="list-group border mb-4">
                <h4 class="p-3 border-bottom titulo__producto">Categorías</h4>
                @foreach($categorias as $categoria)
                    <li class="list-group-item border-0">
                        <a href="{{ route('filtroproducto', ['categoria_id' => $categoria->id]) }}" class="list-menu">
                            {{ $categoria->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <ul class="list-group border">
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

        <!-- Listado de Productos -->
        <div class="col-md-9 ">
            @if($productos->isEmpty())
                <p>No hay productos disponibles.</p>
            @else
                <div class="row">
                    @foreach($productos as $producto)
                        <div class="col-6 col-md-4">
                            <div class="card mb-4">
                                <img src="{{ asset(Storage::url($producto->imagen)) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                                <div class="card-body">
                                    <p>{{ $producto->categoria->nombre }}</p>
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="card-text">{!! $producto->descripcion !!}</p>
                                    <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}</p>
                                    {{-- <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Ver Producto</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


@endsection