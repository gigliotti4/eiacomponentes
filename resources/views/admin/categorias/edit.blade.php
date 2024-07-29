@extends('admin.layouts.master')  

@section('content')
<form method="post" action="{{route('admin.categorias.update',$categoria->id)}}" enctype="multipart/form-data">
	@csrf
  @method('put')
  <div class="form-group col-md-6">
    <label for="orden">orden</label>
    <input type="text" class="form-control" id="orden" name="orden" value="{{$categoria->orden}}">   
  </div>
<div class="form-group col-md-6 my-4">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$categoria->nombre}}">   
  </div>

 <button type="submit" class="btn btn-primary">Editar</button>
</form>


@endsection
