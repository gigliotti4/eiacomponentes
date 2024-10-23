@extends('layouts.app')
@section('title', 'Carrito de compra')

@section('content')



@if(Auth::guard('logincliente')->user()->role === 'fabricante')
<div class="container my-5">
    <div class="alert alert-info">
        {!!$carritoinfo->desc_fabricante!!}
    </div>
</div>
@elseif(Auth::guard('logincliente')->user()->role === 'mayorista')
<div class="container my-5">
    <div class="alert alert-info">
        {!!$carritoinfo->desc_mayorista!!}
    </div>
</div>
@elseif(Auth::guard('logincliente')->user()->role === 'minorista')
<div class="container my-5">
    <div class="alert alert-info">
        {!!$carritoinfo->desc_minorista!!}
    </div>
</div>
        @endif
        <form action="{{ route('presupuesto.pedir') }}" method="POST">
            @csrf
<div class="container my-5">

    <div class="row">
        <div class="col-md-12">
            
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Cantidad</th>
                                    <th>Presentacion</th>
                                    <th>Cant minima</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr id="cart-item-{{ $item->rowId }}">
                                    <td><img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" style="width: 50px;"></td>
                                    <td><strong>{{ $item->options->codigo }}</strong></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ @$item->options->colores['color_seleccionado'] }}</td>
                                    <td>
                                        <div class="wrapper mb-4">
                                            <button type="button" class="plusminus" onclick="handleMinus('{{ $item->rowId }}')">-</button>
                                            <input type="number" 
                                                   class="form-control text-center border-0 form-control-sm cantidad-input{{ $item->rowId }}" 
                                                   name="qty" min="{{ $item->options->cantidad_minima }}" 
                                                   value="{{ $item->qty }}" 
                                                   data-presentacion="{{ $item->options->presentacion }}" 
                                                   data-cantidad-minima="{{ $item->options->cantidad_minima }}" 
                                                   required>
                                            <button type="button" class="plusminus" onclick="handlePlus('{{ $item->rowId }}')">+</button>
                                        </div>
                                    </td>
                                    <td>{{ $item->options->presentacion }}</td>
                                    <td>{{ $item->options->cantidad_minima }}</td>
                                    {{-- <td>
                                        <span id="subtotal-{{ $item->rowId }}">${{ number_format($item->subtotal, 2, ',', '.') }}</span> <!-- Subtotal por producto -->
                                    </td> --}}
                                    <td>
                                        <img src="{{ asset('img/remove.png') }}" class="remove-item" data-rowid="{{ $item->rowId }}" style="cursor: pointer;">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                            
                        </table>
            
            <div class="d-flex justify-content-between">
                <a href="{{route('cart.index')}}" class="btn btn__white mt-3">< Seguir comprando</a>   
                <button type="submit" class="btn btn__rojo mt-3">Pedir presupuesto</button>   
                
            </div>
        </div>
 
        
    </div>
</div>
</form>

@endsection
@push('scripts')
<script>
function handlePlus(rowId) {
    let input = document.querySelector('.cantidad-input' + rowId);
    let currentValue = parseInt(input.value);
    let presentacion = parseInt(input.getAttribute('data-presentacion')); // Obtener la presentación del producto

    if (!isNaN(currentValue)) {
        input.value = currentValue + presentacion; // Aumentar en múltiplos de la presentación
        updateCart(rowId, input.value);
    }
}

function handleMinus(rowId) {
    let input = document.querySelector('.cantidad-input' + rowId);
    let currentValue = parseInt(input.value);
    let presentacion = parseInt(input.getAttribute('data-presentacion')); // Obtener la presentación del producto
    let cantidadMinima = parseInt(input.getAttribute('data-cantidad-minima')); // Obtener la cantidad mínima

    if (!isNaN(currentValue) && currentValue > cantidadMinima) {
        // Disminuir en múltiplos de la presentación, pero nunca por debajo de la cantidad mínima
        input.value = (currentValue - presentacion >= cantidadMinima) ? currentValue - presentacion : cantidadMinima;
        updateCart(rowId, input.value);
    }
}


function updateCart(rowId, qty) {
    $.ajax({
        url: "{{ route('cart.update') }}",
        type: 'POST',
        data: {
            rowId: rowId,
            qty: qty
        },
        success: function(data) {
           // toastr.success('Cantidad Actualizada.');
            // Eliminar location.reload(), ya que actualizamos dinámicamente
        },
        error: function(data) {
            console.error(data.responseText);
            toastr.error('Hubo un error al actualizar la cantidad.');
        }
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.remove-item').click(function() {
        var rowId = $(this).data('rowid');

        $.ajax({
            url: "{{ route('cart.remove') }}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                rowId: rowId,
            },
            success: function(response) {
                // Elimina el producto del DOM
                $('#cart-item-' + rowId).remove();

                // Actualiza los totales del carrito
                $('#cart-subtotal').text('$ ' + response.cartSubtotal);
                $('#cart-total').text('$ ' + response.cartTotal);

                toastr.error('Producto eliminado del carrito');
            },
            error: function(xhr, status, error) {
                toastr.error('Error al eliminar el producto');
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endpush
