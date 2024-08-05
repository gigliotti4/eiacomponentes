@extends('layouts.app')
@section('title', 'Carrito de compra')

@section('content')



<div class="container my-5">
    <div class="row">
    
            @if ($productos->isEmpty())
                <p>No hay productos disponibles.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Colores</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Un. x caja</th>
                            <th scope="col">Precio Un.
                                sin descuento</th>
                            <th scope="col">Accion</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>
                                    <img src="{{ asset(Storage::url($producto->imagen)) }}" alt="{{ $producto->nombre }}" style="width: 50px; height: auto;">
                                </td>
                                <td>COD.{{ $producto->codigo }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td> <select name="color_{{ $producto->id }}" class="form-select">
                                    @foreach ($producto->colores as $color)
                                        <option value="{{ $color->nombre }}">{{ $color->nombre }}</option>
                                    @endforeach
                                </select></td>
                                <td>
                                    <div class="wrapper d-flex">
                                        <button class="plusminus" onclick="handleMinus({{ $producto->id }})">-</button>
                                        <input type="number" class="form-control text-center border-0 form-control-sm cantidad-input{{$producto->id}}" name="qty" pattern="[0-9]+" title="Ingrese solo números" inputmode="numeric" min="1" value="1" required>
                                        <button class="plusminus" onclick="handlePlus({{ $producto->id }})">+</button>
                                    </div>
                                </td>
                                <td>unidad</td>
                                <td>${{ number_format($producto->precio, 2, ',', '.') }}</td>
                                <td>
                                    <button type="submit" data-id="{{$producto->id}}"
                                        {{-- data-categoria="{{$producto->categoria->nombre}}" --}}
                                        data-colores="{{ $producto->colores->pluck('color')->implode(', ') }}"
                                        data-nombre="{{$producto->nombre}}"
                                        data-precio="{{$producto->precio}}"
                                        data-imagen="{{ asset(Storage::url($producto->imagen)) }}"
                                        class="add-cart btn btn__white {{ !isset($producto->precio) ? 'disabled' : '' }}" {{ !isset($producto->precio) ? 'disabled' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M5.00416 16C4.59128 16 4.23795 15.8435 3.94418 15.5304C3.65041 15.2173 3.50327 14.8405 3.50277 14.4C3.50277 13.96 3.64991 13.5835 3.94418 13.2704C4.23845 12.9573 4.59178 12.8005 5.00416 12.8C5.41704 12.8 5.77062 12.9568 6.06489 13.2704C6.35916 13.584 6.50605 13.9605 6.50555 14.4C6.50555 14.84 6.35866 15.2168 6.06489 15.5304C5.77112 15.844 5.41754 16.0005 5.00416 16ZM12.5111 16C12.0982 16 11.7449 15.8435 11.4511 15.5304C11.1573 15.2173 11.0102 14.8405 11.0097 14.4C11.0097 13.96 11.1568 13.5835 11.4511 13.2704C11.7454 12.9573 12.0987 12.8005 12.5111 12.8C12.924 12.8 13.2776 12.9568 13.5718 13.2704C13.8661 13.584 14.013 13.9605 14.0125 14.4C14.0125 14.84 13.8656 15.2168 13.5718 15.5304C13.2781 15.844 12.9245 16.0005 12.5111 16ZM4.36607 3.2L6.16774 7.2H11.4226L13.487 3.2H4.36607ZM3.65291 1.6H14.7256C15.0134 1.6 15.2324 1.7368 15.3825 2.0104C15.5326 2.284 15.5389 2.56053 15.4013 2.84L12.7363 7.96C12.5987 8.22667 12.4143 8.43333 12.183 8.58C11.9518 8.72667 11.6983 8.8 11.4226 8.8H5.82992L5.00416 10.4H14.0125V12H5.00416C4.44114 12 4.01575 11.7368 3.72798 11.2104C3.44022 10.684 3.4277 10.1605 3.69045 9.64L4.70388 7.68L2.00139 1.6H0.5V0H2.93975L3.65291 1.6Z" fill="#131313"/>
                                          </svg>
                                </button> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
      
        
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
    url: "{{ route('cart.add') }}",
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