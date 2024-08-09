@extends('admin.layouts.master')

@section('content')
<h3>Editar zona</h3>
<form method="post" action="{{ route('admin.zonaspostales.update', $zona->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Para indicar que es un método PUT (actualización) --}}
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$zona->nombre}}">
        </div>
        <div class="form-group col-md-6">
            <label for="costo">costo</label>
            <input type="text" class="form-control" id="costo" name="costo" value="{{$zona->costo}}">
        </div>
    </div>
   
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</form>
@endsection