@extends('layouts.app')
@section('title', 'Empresa')
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


<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
       
            <h3 class="titulo__secciones">{{$empresa->titulo}}</h3>
            <p class="contenido__descripcion mt-3">{!!$empresa->descripcion!!}</p>
            {{-- <a type="button" href="" class="btn btn__azul mb-2 px-5" >MÁS INFORMACIÓN</a> --}}
     
         </div>
        <div class="col-md-6">
            <div style="background-image: url('{{asset(Storage::url($empresa->imagen))}}');
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            height:500px;
            ">

            </div>
        </div>
      
    </div>
</div>


<div class="bg-grey my-5">
    <div class="container">
        <div class="row py-5">
            <h3 class="titulo__secciones pb-3">¿Por qué elegirnos?</h3>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-duration="1500">
                <div class="bg__card w-100">
                    <div class="">
                        <img src="{{asset(Storage::url($empresa->icono_mision))}}" class="text-left" style="height:50px;weight:50px;">
                        <h3 class="card__titulo my-4">Misión</h3>
                        <span class="card__texto">{!!$empresa->texto_mision!!}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-duration="1500">
                <div class="bg__card w-100">
                    <div class="">
                        <img src="{{asset(Storage::url($empresa->icono_vision))}}" class="text-left" style="height:50px;weight:50px;">
                        <h3 class="card__titulo my-4">Visión</h3>
                        <span class="card__texto">{!!$empresa->texto_vision!!}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-duration="1500">
                <div class="bg__card w-100">
                    <div class="">
                        <img src="{{asset(Storage::url($empresa->icono_valores))}}" class="text-left" style="height:50px;weight:50px;">
                        <h3 class="card__titulo my-4">Valores</h3>
                        <span class="card__texto">{!!$empresa->texto_valores!!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>












@endsection