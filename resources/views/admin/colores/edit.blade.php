@extends('admin.layouts.master')

@section('content')
<h3>Editar Color</h3>
<form method="post" action="{{ route('admin.colores.update', $color->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="orden">Orden</label>
            <input type="text" class="form-control" id="orden" name="orden" value="{{ $color->orden }}">
        </div>
        <div class="form-group col-md-6">
            <label for="nombre">nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $color->nombre }}">
        </div>
    </div>
  
        
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
@endsection


