@extends('layouts.app')
@section('title', 'Carrito de compra')

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
        width: 8vw;
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
    .card__header{
    color: #000;
        padding: 20px;
    /* Subtitle/S4 */
    background-color: white;
    font-family: "Work Sans";
    font-size: 24px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; 
    }
    .card__categoria{
        color: var(--Azul, #FE2324);
        font-family: "Work Sans";
        font-size: 15px;
        font-style: normal;
        font-weight: 700;
        line-height: 150%; /* 18px */
    }
    .card__titulo{
        color: #000;
        /* Body/Regular/Body 20 */
        font-family: "Work Sans";
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 30px */

    }

    .card__precio{
        color: #000;
        text-align: left;
        /* Heading/H4 */
        font-family: "Work Sans";
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: 120%;
    }

    .cart__numero{
        color: #000;
        text-align: right;
        /* Body/Bold/Body 20 */
        font-family: "Work Sans";
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: 150%; /* 30px */
    }
</style>

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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td><img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" style="width: 50px;"></td>
                                    <td>
                                        <strong>

                                            {{ $item->options->codigo }}
                                        </strong>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{@$item->options->colores['color_seleccionado'];}} </td>
                                    <td>
                                        <div class="wrapper mb-4">
                                            <button class="plusminus" onclick="handleMinus('{{ $item->rowId }}')">-</button>
                                            <input type="number" class="form-control text-center border-0 form-control-sm cantidad-input{{ $item->rowId }}" name="qty" pattern="[0-9]+" title="Ingrese solo números" inputmode="numeric" min="1" value="{{ $item->qty }}" required>
                                            <button class="plusminus" onclick="handlePlus('{{ $item->rowId }}')">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="{{ asset('img/remove.png') }}" class="remove-item" data-rowid="{{ $item->rowId }}" style="cursor: pointer;"> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            
            <div class="d-flex justify-content-between">
                <a href="{{route('cart.index')}}" class="btn btn__white mt-3">< Seguir comprando</a>   
                <a href="{{route('categorias')}}" class="btn btn__rojo mt-3">Pedir presupuesto</a>   
                
            </div>
        </div>
 
        
    </div>
</div>

@endsection
@push('scripts')
<script>
     function handlePlus(rowId) {
    let input = document.querySelector('.cantidad-input' + rowId);
    let currentValue = parseInt(input.value);
    if (!isNaN(currentValue)) {
        input.value = currentValue + 1;
        updateCart(rowId, input.value);
    }
}

function handleMinus(rowId) {
    let input = document.querySelector('.cantidad-input' + rowId);
    let currentValue = parseInt(input.value);
    if (!isNaN(currentValue) && currentValue > 1) {
        input.value = currentValue - 1;
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
         //   toastr.success('¡Cantidad actualizada con éxito!');

            // Update the item's subtotal
            $('#subtotal-' + rowId).text('$ ' + data.subtotal);

            // Update the cart totals
            $('#cart-subtotal').text('$ ' + data.cartSubtotal);
            $('#cart-total').text('$ ' + data.cartTotal);
            location.reload();  // Recarga la página para reflejar los cambios en el carrito
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
                // Remove the item from the DOM
                $('#cart-item-' + rowId).remove();
                location.reload();  // Recarga la página para reflejar los cambios en el carrito
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
