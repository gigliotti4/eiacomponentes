@extends('admin.layouts.master')

@section('content')
<h3>Editar Aplicacion</h3>
<form method="post" action="{{ route('admin.colores.update', $aplicacion->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="orden">Orden</label>
            <input type="text" class="form-control" id="orden" name="orden" value="{{ $aplicacion->orden }}">
        </div>
        <div class="form-group col-md-6">
            <label for="titulo">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $aplicacion->titulo }}">
        </div>
    </div>
  
        
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
@endsection


