@extends('admin.layouts.master')

@section('content')
<h3>Editar producto</h3>
<form method="post" action="{{ route('admin.productos.update', ['id' => $producto->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Para indicar que es un método PUT (actualización) --}}
    <div class="row">
        <div class="form-group col-md-4">
            <label for="orden">Orden</label>
            <input type="text" class="form-control" id="orden" name="orden" value="{{ $producto->orden }}">
        </div>
        <div class="form-group col-md-4">
            <label for="nombre">nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}">
        </div>
        <div class="form-group col-md-4">
            <label for="codigo">codigo</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $producto->codigo }}">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}">
        </div>
        
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="cantidad">cantidad</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{ $producto->cantidad }}">
        </div>
        <div class="form-group col-md-6">
            <label for="descuento">Descuento</label>
            <input type="text" class="form-control" id="descuento" name="descuento" value="{{ $producto->descuento }}">
        </div>
        <div class="form-group col-md-6">
            <label for="cantidad_dos">Cantidad dos</label>
            <input type="text" class="form-control" id="cantidad_dos" name="cantidad_dos" value="{{ $producto->cantidad_dos }}">
        </div>
        <div class="form-group col-md-6">
            <label for="descuento_dos">Descuento dos</label>
            <input type="text" class="form-control" id="descuento_dos" name="descuento_dos" value="{{ $producto->descuento_dos }}">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control summernote" name="descripcion" id="descripcion" cols="30" rows="10">{{ $producto->descripcion }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 my-4">
            <label for="categoria_id">Categoría</label>
            <select class="form-control" id="categoria_id" name="categoria_id">
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @if($producto->categoria_id == $categoria->id) selected @endif>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 my-4">
            <label for="colores">Colores</label>
            <select class="form-control" id="colores" name="colores[]" multiple="multiple">
                @foreach($colores as $color)
                    <option value="{{ $color->id }}" @if(in_array($color->id, $producto->colores->pluck('id')->toArray())) selected @endif>{{ $color->nombre }}</option>
                @endforeach
            </select>
        </div>
   

    </div>
    
    <div class="form-group col-md-6 my-4">
        <label for="imagen">Imagen 900x675px</label> <br>
        <input type="file" class="form-control-file" id="imagen" name="imagen">
        @if($producto->imagen)
            <p>Imagen actual:</p>
            <img src="{{asset(Storage::url($producto->imagen))}}" class="img-thumbnail mt-2 w-25">
        @endif
    </div>
    <div class="form-group my-3 ">
        <label for="galeria">Galería 288x288px</label> <br>
        <input type="file" class="form-control-file" id="galeria" name="galeria[]" multiple>
        @if ($producto->galeria)
        <div class="image-gallery d-flex flex-wrap my-5">
            @foreach (json_decode($producto->galeria, true) as $key => $galerias)
                <div class="image-container position-relative mr-2 mb-2" id="image-{{ $key }}">
                    <img src="{{ asset(Storage::url($galerias)) }}" alt="" class="gallery-image">
                    <button class="btn btn-danger btn-sm delete-image position-absolute" data-id="{{ $producto->id }}" data-key="{{ $key }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endforeach
        </div>
        @else
            @if (!empty($producto->galeria))
                <p>No hay imágenes en la galería.</p>
            @endif
        @endif
    </div>

   

    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#colores').select2({
        placeholder: "Seleccione uno o más colores",
        allowClear: true
    });

    $('.delete-image').click(function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var key = $(this).data('key');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/productos') }}/eliminar-imagen/" + id + "/" + key,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#image-' + key).remove();
                            toastr.success('Imagen eliminada correctamente');
                        } else {
                            toastr.error('Error al eliminar la imagen');
                        }
                    },
                    error: function(response) {
                        toastr.error('Error al eliminar la imagen');
                    }
                });
            }
        });
    });
});
</script>
@endpush