@extends('layouts.app')
@section('title', 'Productos')
@section('content')
<style>
    .titulo__producto{
        color: #000;
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


    input[type="number"] {
        -webkit-appearance: textfield !important;
        -moz-appearance: textfield !important;
        appearance: textfield !important;
    }
    
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
    
    .wrapper {
    border-radius: 4px;
    border: 1px solid var(--Gris, #D1D2D4);
    width: 4vw;
    padding: 3px;
    display: flex;

    }
    
    .plusminus {
        height: 100%;
        width: 30%;
        background: white;
        border: none;
        color: #000;
        text-align: center;
        font-family: 'Ubuntu';
        font-size: 21px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    
    .num {
        height: 100%;
        width: 39%;
        border: none;
        color: #000;
        text-align: center;
        font-family: 'Ubuntu';
        font-size: 19px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    .card-subtitulo{
    color: var(--Azul, #FE2324);
    font-family: "Work Sans";
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 150%; 
    }
    .card-codigo{
    color: var(--Negro, #000);
    text-align: right;
 
    font-family: "Work Sans";
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%;
    }
    .card-titulo{
    color: var(--Gris-medio, #4F4F4F);
    font-family: "Work Sans";
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%;
    }
    .card-precio{
        color: var(--Negro, #1A171B);
        font-family: "Work Sans";
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: 120%; 
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
                       {{-- <div class="d-flex justify-content-around align-items-center">
                            <div class="wrapper ">
                                <button class="plusminus" onclick="handleMinus({{ $producto->id }})">-</button>
                                <input type="number" class="form-control border-0 text-center form-control-sm cantidad-input{{$producto->id}}" name="qty" pattern="[0-9]+" title="Ingrese solo números" inputmode="numeric" min="1" value="1" required>
                                <button class="plusminus" onclick="handlePlus({{ $producto->id }})">+</button>
                            </div>
                            <button type="submit" data-id="{{$producto->id}}"
                                data-categoria="{{$producto->categoria->nombre}}"
                                data-colores="{{ $producto->colores->pluck('color')->implode(', ') }}"
                                data-nombre="{{$producto->nombre}}"
                                data-precio="{{$producto->precio}}"
                                data-imagen="{{ asset(Storage::url($producto->imagen)) }}"
                                class="add-cart btn btn__white {{ !isset($producto->precio) ? 'disabled' : '' }}" {{ !isset($producto->precio) ? 'disabled' : '' }}>
                            Agregar al carrito
                        </button> 
                        </div>--}}
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
