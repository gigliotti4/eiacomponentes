@extends('layouts.app')
@section('title', $producto->nombre)
@section('content') 
<div class="bg__breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{route('index')}}">{{$producto->categoria->nombre}}</a></li>
              <strong class="breadcrumb-item active" >{{$producto->nombre}}</li>
            </ol>
          </nav>
    </div>
</div> 

<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <div class="fotorama" data-nav="thumbs" data-width="100%" data-height="500" data-ratio="16/9">
                @foreach (json_decode($producto->galeria, true) as $imagen)
                    <img src="{{ asset(Storage::url($imagen)) }}" alt="Imagen" class="border" style="object-fit:cover;">
                @endforeach
            </div>
            
            
        </div>
        <div class="col-md-6">
            <div class="d-flex">
                <h4 class="producto__categoria ">
                    {{$producto->categoria->nombre}}
                </h4>
                    
                <span class=" ms-2 producto__codigo">
                 |   {{$producto->codigo}}
                </span>
            </div>
            <h3 class="producto__titulo">
                {{$producto->nombre}}
            </h3>
            <hr>
            <div class="d-flex flex-column ">

                <span class="producto__descripcion ">{!!$producto->descripcion!!}</span>
                <span class="producto__descripcion mt-5">Seleccione el color</span>
                <select name="color_{{ $producto->id }}" class="form-select w-25 mb-5">
                    @foreach ($producto->colores as $color)
                        <option value="{{ $color->nombre }}">{{ $color->nombre }}</option>
                    @endforeach
                </select>
                <hr>
                <p class="producto__precio "> ${{ number_format($producto->precio, 2, ',', '.') }}</p>
                <div class="row mt-5">

                    <div class="col-6 col-md-6">
       
                        <div class="wrapper-producto ">
                            <button class="plusminus" onclick="handleMinus({{ $producto->id }})">-</button>
                            <input type="number" class="form-control border-0 text-center form-control-sm cantidad-input{{$producto->id}}" name="qty" pattern="[0-9]+" title="Ingrese solo números" inputmode="numeric" min="1" value="1" required>
                            <button class="plusminus" onclick="handlePlus({{ $producto->id }})">+</button>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
       
                        <button type="submit" data-id="{{$producto->id}}"
                            data-categoria="{{$producto->categoria->nombre}}"
                            data-colores="{{ $producto->colores->pluck('color')->implode(', ') }}"
                            data-nombre="{{$producto->nombre}}"
                            data-precio="{{$producto->precio}}"
                            data-imagen="{{ asset(Storage::url($producto->imagen)) }}"
                            data-descuento="{{$producto->descuento}}"
                            data-cantidad="{{$producto->cantidad}}"
                            data-cantidad_dos="{{$producto->cantidad_dos}}"
                            data-descuento_dos="{{$producto->descuento_dos}}"
                            class="add-cart btn btn__white w-100 {{ !isset($producto->precio) ? 'disabled' : '' }}" {{ !isset($producto->precio) ? 'disabled' : '' }}>
                        Agregar al carrito
                    </button> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')


<script>
    function handlePlus(productId) {
        let input = document.querySelector('.cantidad-input' + productId);
        let currentValue = parseInt(input.value);
        if (!isNaN(currentValue)) {
            input.value = currentValue + 1;
        }
    }

    function handleMinus(productId) {
        let input = document.querySelector('.cantidad-input' + productId);
        let currentValue = parseInt(input.value);
        if (!isNaN(currentValue) && currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    // Configuración global de AJAX para incluir el token CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-cart').on('click', function() {
  let id = $(this).data('id');
  let codigo = $(this).data('codigo');
  let nombre = $(this).data('nombre');
  let precio = $(this).data('precio');
  let imagen = $(this).data('imagen');
  let qty = $('.cantidad-input' + id).val();

  // Obtener el color seleccionado
  let selectedColor = $(`select[name=color_${id}]`).val();

    // Obtener los valores adicionales
    let cantidad = $(this).data('cantidad');
    let descuento = $(this).data('descuento');
    let cantidadDos = $(this).data('cantidad_dos');
    let descuentoDos = $(this).data('descuento_dos');

  // Validar cantidad
  if (!qty || qty <= 0) {
    toastr.error('Por favor, ingrese una cantidad válida.');
    return;
  }

  // Realizar la petición AJAX para añadir el producto al carrito
  $.ajax({
    url: "{{ route('cart.add.consumidor') }}",
    type: 'POST',
    data: {
      producto_id: id,
      codigo: codigo,
      nombre: nombre,
      precio: precio,
      imagen: imagen,
      color: selectedColor,
      cantidad: qty,
      cantidad: cantidad,
      descuento: descuento,
      cantidad_dos: cantidadDos,
      descuento_dos: descuentoDos
    },
    success: function(data) {
      toastr.success('¡Producto añadido con éxito!');
      // Actualizar la cantidad en el icono del carrito
      $('#cart-count').text(data.cartCount);
    },
    error: function(data) {
      console.error(data.responseText);
      toastr.error('Hubo un error al añadir el producto al carrito.');
    }
  });
});
</script>

    
  
@endpush