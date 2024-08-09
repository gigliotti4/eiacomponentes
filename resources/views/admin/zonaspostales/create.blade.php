@extends('admin.layouts.master')

@section('content')
<h3>Nueva zona</h3>
<form method="post" action="{{ route('admin.zonaspostales.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group col-md-6">
            <label for="costo">costo</label>
            <input type="text" class="form-control" id="costo" name="costo">
        </div>
    </div>
   
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
</form>
@endsection