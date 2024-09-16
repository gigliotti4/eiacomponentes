@extends('layouts.app')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicadores -->
    <div class="carousel-indicators justify-content-center">
        @foreach($sliders as $index => $slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($sliders as $index => $slider)
            @if(Str::contains($slider->imagen, ['.mp4', '.mov', '.avi']))
                <!-- Elemento - Video -->
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="carousel-video-wrapper">
                        <video class="carousel-video" autoplay loop muted>
                            <source src="{{ asset(Storage::url($slider->imagen)) }}" type="video/mp4">
                            Tu navegador no soporta video HTML5.
                        </video>
                        <div class="carousel-caption text-center">
                            <h5 class="carousel__titulo">{{ $slider->titulo }}</h5>
                            <p class="carousel__descripcion">{!! $slider->descripcion !!}</p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Elemento - Imagen como background -->
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="background-image: url('{{ asset(Storage::url($slider->imagen)) }}'); background-size: cover; background-position: center; height: 100vh;">
                    <div class="carousel-caption text-center" style="">
                        <h5 class="carousel__titulo">{{ $slider->titulo }}</h5>
                        <p class="carousel__descripcion">{!! $slider->descripcion !!}</p>
                        <a type="button" href="{{ route('empresa') }}" class="btn btn__transparente mb-2 px-5" >MÁS INFORMACIÓN</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>


<div class="container my-5">
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
</div>


<div class=" mt-5" style="overflow: hidden" data-aos="fade-up" data-aos-duration="1500">
    <div class="row ">
        <div class="col-md-6 p-0">
            <div style="background-image: url('{{asset(Storage::url($inicio->imagen))}}');
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            height:600px;
            ">

            </div>
        </div>
        <div class="col-md-6 p-5 " style="background: var(--Azul, #FE2324);">
       

                <h3 class="contenido__titulo">{{$inicio->titulo}}</h3>
                <div class="contenido__descripcion my-5">{!!$inicio->descripcion!!}</div>
                <a type="button" href="{{ route('empresa') }}" class="btn btn__white mb-2 px-5" >MÁS INFORMACIÓN</a>
          
         
        </div>
    </div>
</div>








@endsection


