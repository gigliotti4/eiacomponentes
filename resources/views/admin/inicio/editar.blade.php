@extends('admin.layouts.master')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<form method="post" action="{{ route('admin.inicio.update', ['id' => $contenido->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('put') <!-- Usando 'put' para la actualización -->

    <div class="form-group">
        <label for="titulo" class="font-weight-bold">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $contenido->titulo }}">
    </div>

    <div class="form-group my-4">
        <label for="descripcion" class="font-weight-bold">Descripcion</label>
        <textarea class="form-control summernote" name="descripcion" id="descripcion" cols="30" rows="10">{!! $contenido->descripcion !!}</textarea>
    </div>

    <div class="form-group">
        <label for="imagen" class="font-weight-bold">Imagen (tamaño 671 × 580 px)</label><br>
        <input type="file" class="form-control-file my-3" id="imagen" name="imagen"> <br>
        <img src="{{ asset(Storage::url($contenido->imagen)) }}" class="img-thumbnail w-25 mt-4">
    </div>
    <button type="submit" class="btn btn-primary">Editar</button>
</form>
@endsection

