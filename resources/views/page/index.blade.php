@extends('layouts.app')

@section('content')
@include('components.carrousel')


<div class=" mt-5" style="overflow: hidden" data-aos="fade-up" data-aos-duration="1500">
    <div class="row">
        <div class="col-md-6 p-0">
            <div style="background-image: url('{{asset(Storage::url($inicio->imagen))}}');
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            height:600px;
            ">

            </div>
        </div>
        <div class="col-md-6 p-5" style="background: var(--Azul, #FE2324);">
       
                <h3 class="contenido__titulo">{{$inicio->titulo}}</h3>
                <p class="contenido__descripcion my-5">{!!$inicio->descripcion!!}</p>
                <a type="button" href="{{ route('empresa') }}" class="btn btn__white mb-2 px-5" >MÁS INFORMACIÓN</a>
         
        </div>
    </div>
</div>








@endsection


@push('scripts')
  
@endpush
