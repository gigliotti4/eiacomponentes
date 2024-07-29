@extends('admin.layouts.master')
@section('content')
<h3>Nueva Categoria </h3>
<form method="post" action="{{route('admin.categorias.store')}}" enctype="multipart/form-data">
	@csrf
    <div class="form-group col-md-6">
      <label for="orden">Orden</label>
      <input type="text" class="form-control" id="orden" name="orden" >
      
    </div>
    <div class="form-group col-md-6 my-4">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" >
      
    </div>
  <div class="d-flex justify-content-start">
    <button type="submit" class="btn btn-primary ">Agregar</button>

  </div>
</form>

@endsection