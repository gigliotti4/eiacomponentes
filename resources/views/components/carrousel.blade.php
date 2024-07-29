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
                <!-- Elemento - Imagen -->
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset(Storage::url($slider->imagen)) }}" class="d-block w-100 carousel-imagen" alt="{{ $slider->titulo }}">
                    <div class="carousel-caption text-center">
                        <h5 class="carousel__titulo">{{ $slider->titulo }}</h5>
                        <p class="carousel__descripcion">{!! $slider->descripcion !!}</p>
                        <a type="button" href="{{ route('empresa') }}" class="btn btn__transparente mb-2 px-5" >MÁS INFORMACIÓN</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
