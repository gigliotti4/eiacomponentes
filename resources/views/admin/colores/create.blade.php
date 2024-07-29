@extends('admin.layouts.master')

@section('content')
<h3>Nueva Color</h3>
<form method="post" action="{{ route('admin.colores.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="orden">Orden</label>
            <input type="text" class="form-control" id="orden" name="orden">
        </div>
        <div class="form-group col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
    </div>
    <div class="row my-4">
        <div class="form-group col-md-6">
            <label for="color">Selecciona un color</label>
            <input type="color" class="form-control" id="color" name="color">
        </div>
    </div>
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
</form>
@endsection

