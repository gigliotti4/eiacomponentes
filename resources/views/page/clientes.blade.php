@extends('layouts.app')
@section('title', 'Clientes')
@section('content')

<div class="bg__breadcrumb">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Clientes</li>

            </ol>
            <span class="breadcrumb-titulo">Clientes</span>
          </nav>
    </div>
</div>





<div class="container my-5" style="overflow: hidden" data-aos="fade-up" data-aos-duration="1500">
        <div class="row">
            @foreach($clientes as $brand)  
                <div class="col-6 col-md-2 mt-2 ">
                    <div class="border bg-white" style="background-image: url('{{ asset(Storage::url($brand->imagen)) }}');
                            height:184px;
                            width: 100%;
                            background-size:144px;
                            background-repeat: no-repeat;
                            background-position: center;">
                    </div>
                </div>
            @endforeach
        </div>
</div>










@endsection