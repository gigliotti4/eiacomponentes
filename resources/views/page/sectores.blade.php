@extends('layouts.app')
@section('title', 'Sectores')
@section('content')
<div class="bg__breadcrumb w-100">

<div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Sectores</li>

            </ol>
            <span class="breadcrumb-titulo">sectores</span>
          </nav>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        @forelse($sectores as $index => $sector)
        <div class="col-md-4 mb-4">
            <div class="media-item" data-bs-toggle="modal" data-bs-target="#mediaModal" data-index="{{ $index }}">
                @if (Str::contains($sector->imagen, ['.mp4', '.mov', '.avi']))
                    <video width="100%" height="392" class="" autoplay loop muted>
                        <source src="{{ asset(Storage::url($sector->imagen)) }}" type="video/mp4">
                        Tu navegador no soporta video HTML5.
                    </video>
                @else
                    <img src="{{ asset(Storage::url($sector->imagen)) }}" class="w-100" alt="Imagen">
                @endif
            </div>
            <div class="text-center">
                <div class="p-2">{{ $sector->titulo }}</div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p>No se encontraron sectores.</p>
        </div>
        @endforelse
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="mediaModalLabel">Sectores</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($sectores as $index => $sector)
                        <div class="carousel-item @if($index == 0) active @endif">
                            @if (Str::contains($sector->imagen, ['.mp4', '.mov', '.avi']))
                                <video class="d-block custom-video" autoplay loop muted>
                                    <source src="{{ asset(Storage::url($sector->imagen)) }}" type="video/mp4">
                                    Tu navegador no soporta video HTML5.
                                </video>
                            @else
                                <img src="{{ asset(Storage::url($sector->imagen)) }}" class="d-block w-100" alt="Imagen">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<script>
    $(document).ready(function() {
        $('.media-item').on('click', function() {
            var index = $(this).data('index');
            $('#carouselExampleControls').carousel(index);
        });
    });
</script>

@endpush