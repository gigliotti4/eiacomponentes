@extends('layouts.app')
@section('title', 'Comprar')
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
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="background-image: url('{{ asset(Storage::url($slider->imagen)) }}'); background-size: cover; background-position: center; height: 50vh;">
                    <div class="carousel-caption text-center" style="">
                        <h5 class="carousel__titulo">{{ $slider->titulo }}</h5>
                        <p class="carousel__descripcion">{!! $slider->descripcion !!}</p>
                        {{-- <a type="button" href="{{ route('empresa') }}" class="btn btn__transparente mb-2 px-5" >MÁS INFORMACIÓN</a> --}}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<style>

.texto__compra{
    color: #131313;

text-align: center;
/* Subtitle/S5 */
font-family: "Work Sans";
font-size: 20px;
font-style: normal;
font-weight: 400;
line-height: 120%
}
</style>

<div class="container my-5">
    <div class="row">
        <span class="titulo__secciones pb-2 border-bottom">Como comprar</span>
       
        @foreach ($comprar as $compra)
            <div class="col-md-4 mt-5">
                <div class=" border p-5">
                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- Icono -->
                        <img src="{{ asset(Storage::url($compra->icono)) }}" alt="Icono" class="icono mb-2">
                <div class="d-flex">

                    <img src="{{ asset(Storage::url($compra->numero)) }}" alt="Número" class="numero mb-2">
            
                    <!-- Texto -->
                    <div class="texto__compra mt-2 ms-2">
                        {!!$compra->texto!!}
                    </div>
                </div>
                    
                    </div>
                </div>
                
            </div>
        @endforeach
    </div>
</div>





@endsection