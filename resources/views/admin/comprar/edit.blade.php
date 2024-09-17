
@extends('admin.layouts.master')
@section('content')
    <h1>{{ isset($comprar) ? 'Editar' : 'Crear' }} Cómo Comprar</h1>

    <form action="{{ isset($comprar) ? route('admin.comprar.update', $comprar->id) : route('admin.comprar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($comprar))
            @method('PUT')
        @endif
        
        <div class="form-group col-md-6">
            <label for="orden">Orden</label>
            <input type="text" class="form-control" id="orden" name="orden">
        </div>
        <div class="form-group col-md-6">
            <label for="icono">Icono</label>
            <input type="file" name="icono" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="numero">Número</label>
            <input type="file" name="numero" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="texto">Texto</label>
            <textarea name="texto" class="form-control summernote">{{ old('texto', isset($comprar) ? $comprar->texto : '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-2">{{ isset($comprar) ? 'Actualizar' : 'Crear' }}</button>
    </form>
@endsection