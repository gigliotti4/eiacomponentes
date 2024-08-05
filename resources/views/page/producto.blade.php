@extends('layouts.app')
@section('title', $producto->nombre)
@section('content')

<style>
        input[type="number"] {
        -webkit-appearance: textfield !important;
        -moz-appearance: textfield !important;
        appearance: textfield !important;
    }
    
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
    
    .wrapper {
    border-radius: 4px;
    border: 1px solid var(--Gris, #D1D2D4);
    width: 100%;
    padding: 3px;
    display: flex;

    }
    
    .plusminus {
        height: 100%;
        width: 30%;
        background: white;
        border: none;
        color: #000;
        text-align: center;
        font-family: 'Ubuntu';
        font-size: 21px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    
    .num {
        height: 100%;
        width: 39%;
        border: none;
        color: #000;
        text-align: center;
        font-family: 'Ubuntu';
        font-size: 19px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
</style>
<div class="container my-5">
    <div class="row">
        @foreach (json_decode($producto->galeria, true)  as $imagen)
        <div class="col-6 col-md-6 mb-4">
            <img src="{{ asset(Storage::url($imagen)) }}" class="w-100" alt="Imagen">
        </div>
        
        @endforeach
        <div class="col-md-6">
            <h3>
                {{$producto->nombre}}
            </h3>
            <div class="d-flex flex-column ">

                <span>{!!$producto->descripcion!!}</span>
                <select name="color_{{ $producto->id }}" class="form-select w-25 my-5">
                    <span>Seleccione el color</span>
                    @foreach ($producto->colores as $color)
                        <option value="{{ $color->nombre }}">{{ $color->nombre }}</option>
                    @endforeach
                </select>
                <p class="card-precio"> ${{ number_format($producto->precio, 2, ',', '.') }}</p>
                <hr>
                <div class="row mt-5">

                    <div class="col-6 col-md-6">
       
                        <div class="wrapper ">
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
      cantidad: qty
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