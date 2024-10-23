@extends('admin.layouts.master')

@section('content')
<h3>Nuevo Producto</h3>
<form method="post" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-4">
            <label for="orden">Orden</label>
            <input type="text" class="form-control" id="orden" name="orden">
        </div>
        <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group col-md-4">
            <label for="codigo">Codigo</label>
            <input type="text" class="form-control" id="codigo" name="codigo">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="presentacion">Presentacion</label>
            <input type="text" class="form-control" id="presentacion" name="presentacion">
        </div>
          <div class="form-group col-md-6">
            <label for="cantidad_minima">Cantidad Minima</label>
            <input type="text" class="form-control" id="cantidad_minima" name="cantidad_minima">
        </div>
       
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="cantidad">cantidad</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad">
        </div>
        <div class="form-group col-md-6">
            <label for="descuento">Descuento</label>
            <input type="text" class="form-control" id="descuento" name="descuento">
        </div>
        <div class="form-group col-md-6">
            <label for="cantidad_dos">Cantidad dos</label>
            <input type="text" class="form-control" id="cantidad_dos" name="cantidad_dos">
        </div>
        <div class="form-group col-md-6">
            <label for="descuento_dos">Descuento dos</label>
            <input type="text" class="form-control" id="descuento_dos" name="descuento_dos">
        </div>
    </div>
       <div class="row">
        <div class="form-group col-md-6">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio">
        </div>
       
    </div>
<hr>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control summernote" name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 my-4">
            <label for="categorias">Categoría</label>
            <select name="categorias[]" id="categorias" multiple class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        @if(isset($producto) && $producto->categorias->contains($categoria->id)) selected @endif>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            
        </div>
            {{-- <div class="form-group col-md-6 my-4">
                <label for="colores">Colores</label>
                <select class="form-control" id="colores" name="colores[]" multiple="multiple">
                    @foreach($colores as $color)
                        <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                    @endforeach
                </select>
            </div> --}}
       

       
    </div>

    <div class="row">
        <div class="form-group col-md-6 my-4">
            <label for="imagen">Imagen 900x675px</label> <br>
            <input type="file" class="form-control-file" required id="imagen" name="imagen">
        </div>
    </div>

    {{-- <div class="row my-4">
        <div class="form-group col-md-12">
            <label for="galeria">Galeria Tamaño · 225 x 225</label><br>
            <input type="file" class="form-control-file" id="galeria" name="galeria[]" multiple>
        </div>
    </div> --}}

    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // $('#colores').select2({
        //     placeholder: "Seleccione uno o más colores",
        //     allowClear: true
        // });

        $('#categorias').select2({
        placeholder: "Seleccione uno o más categorias",
        allowClear: true
    });
    });
</script>
@endpush
