@extends('admin.layouts.master')

@section('content')
<form method="post" action="{{ route('admin.slider.update', ['seccion' => $seccion, 'id' => $slider->id]) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row">
      <div class="form-group col-md-6">
          <label for="orden">Orden</label>
          <input type="text" class="form-control" id="orden" name="orden" value="{{ $slider->orden }}">
      </div>
      <div class="form-group col-md-6">
          <label for="titulo">Titulo</label>
          <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $slider->titulo }}">
      </div>
  </div>
  <div class="form-group col-md-12">
      <label for="descripcion">Descripción</label>
      <textarea class="form-control summernote" name="descripcion" id="descripcion" cols="30" rows="10">{!! $slider->descripcion !!}</textarea>
  </div>
  <div class="form-group col-md-6">
      <label for="imagen">(Imagen o video) · 900x675px</label> <br>
      <input type="file" class="form-control-file mt-3" id="imagen" name="imagen"> <br>
      @if (Str::contains($slider->imagen, ['.mp4', '.mov', '.avi']))
          <video width="320" height="240" controls>
              <source src="{{ asset(Storage::url($slider->imagen)) }}" type="video/mp4">
              Tu navegador no soporta video HTML5.
          </video>
      @else
          <img src="{{ asset(Storage::url($slider->imagen)) }}" class="img-thumbnail w-50">
      @endif
  </div>
  <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Actualizar</button>
  </div>
</form>


@endsection
