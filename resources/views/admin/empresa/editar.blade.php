@extends('admin.layouts.master')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<form method="post" action="{{route('admin.empresa.update',$empresa->id)}}" enctype="multipart/form-data">
	@csrf
	@method('put')
  <div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" value="{{$empresa->titulo}}">
  </div>
  <div class="form-group">
    <label for="descripcion">Descripcion</label>
    <textarea class="form-control summernote" name="descripcion" id="descripcion" cols="30" rows="10" value="" >{{$empresa->descripcion}}</textarea>  
  </div>
  <div class="form-group">
    <label for="imagen">Imagen (tamaño 671 × 580 px)</label> <br>
    <input type="file" class="form-control-file my-3" id="imagen" name="imagen" value=""> <br>
    <img src="{{asset(Storage::url($empresa->imagen))}}" class="img-thumbnail w-25 mt-4 ">
  </div>
  <hr>


  <div class="row">
    <div class="form-group col-md-4">
      <label for="icono_mision">Icono mision tamaño 66 × 67 px</label> <br>
      <input type="file" class="form-control-file" id="icono_mision" name="icono_mision" value=""> <br>
      <img src="{{asset(Storage::url($empresa->icono_mision))}}" class="img-thumbnail w-25 mt-4 ">
    </div>
    <div class="form-group col-md-4">
      <label for="icono_vision">Icono vision tamaño 66 × 67 px</label><br>
      <input type="file" class="form-control-file" id="icono_vision" name="icono_vision" value=""><br>
      <img src="{{asset(Storage::url($empresa->icono_vision))}}" class="img-thumbnail w-25 mt-4 ">
    </div>
    <div class="form-group col-md-4">
      <label for="icono_valores">Icono Valores tamaño 66 × 67 px</label><br>
      <input type="file" class="form-control-file" id="icono_valores" name="icono_valores" value=""><br>
      <img src="{{asset(Storage::url($empresa->icono_valores))}}" class="img-thumbnail w-25 mt-4 ">
    </div>
  </div>
  <div class="row mb-3">
    <div class="form-group col-md-4">
      <label for="texto_mision">Misión</label>
      <textarea class="form-control summernote" name="texto_mision" id="texto_mision" cols="30" rows="10" value="" >{{$empresa->texto_mision}}</textarea>
      
    </div>
    <div class="form-group col-md-4">
      <label for="texto_vision">Visión</label>
      <textarea class="form-control summernote" name="texto_vision" id="texto_vision" cols="30" rows="10" value="" >{{$empresa->texto_vision}}</textarea>
      
    </div>
    <div class="form-group col-md-4">
      <label for="texto_valores">Valores</label>
      <textarea class="form-control summernote" name="texto_valores" id="texto_valores" cols="30" rows="10" value="" >{{$empresa->texto_valores}}</textarea>
      
    </div>
  </div>


  {{-- <div class="form-group col-md-6">
    <label for="video">video</label>
    <input type="text" class="form-control" id="video" name="video" value="{{$empresa->video}}">
    https://www.youtube.com/watch?v=<strong>lKDGxAHZt0E&list</strong>
  </div> --}}

  
  <div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-success ">Editar</button>

  </div>
</form>
    
  
 
@endsection
