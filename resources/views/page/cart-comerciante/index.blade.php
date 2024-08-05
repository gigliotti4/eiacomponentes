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
<div class="container my-5">

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header card__header">
                   Carrito
                </div>
                @if($cartItems->isEmpty())
                <p>Tu carrito está vacío.</p>
                @else
                @foreach($cartItems as $item)
                <div class="card-body d-flex">
                    <div class="col-md-2">
                        <img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" style="width: 90px;">
                    </div>
                    <div class="col-md-4">  
                        <h4 class="card__categoria">{{ $item->options->categoria }}</h4>
                        <h4 class="card__titulo">{{ $item->name }}</h4>
                    </div>
                    <div class="col-md-3 mt-4">
                        <div class="d-flex">
                            <div class="wrapper mb-4">
                                <button class="plusminus" onclick="handleMinus('{{ $item->rowId }}')">-</button>
                                <input type="number" class="form-control text-center border-0 form-control-sm cantidad-input{{ $item->rowId }}" name="qty" pattern="[0-9]+" title="Ingrese solo números" inputmode="numeric" min="1" value="{{ $item->qty }}" required>
                                <button class="plusminus" onclick="handlePlus('{{ $item->rowId }}')">+</button>
                            </div>
                         <div class=" ms-2">
                             {{@$item->options->colores['color_seleccionado'];}} 
                         </div>
                        {{-- <div class="card-text mt-2 ms-2">{{ $item->options->colores }}</div> --}}
                        </div>  
                    </div>
                    <div class="col-md-2 mt-4">   
                        <p class="card__precio">${{ number_format($item->price, 2, ',', '.') }}</p>
                    </div>
                    <div class="col-md-1 mt-4">   
                        <img src="{{ asset('img/remove.png') }}" class="remove-item" data-rowid="{{ $item->rowId }}" style="cursor: pointer;">    
                    </div>
              </div>
              @endforeach
              @endif
            </div>
            <a href="{{route('categorias')}}" class="btn btn__white mt-3">< Seguir comprando</a>   
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header card__header">
                    Total del carrito
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Subtotal</h4>
                        <span class="cart__numero" id="subtotal" >${{ $cartSubotal }}</span> <!-- Mostrar subtotal -->
                    </div>
                    <h4 class="card-title">Envio</h4>
                    <div class="d-flex my-3 justify-content-between">
                        <div class="form-check ">
                          <input class="form-check-input" type="checkbox" value="" id="local" >
                          <label class="form-check-label" for="local">
                              Retiro local          
                          </label>
                        </div>
                        <div>Gratis</div>
                    </div>
                      <div class="d-flex my-3 justify-content-between">
                          <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="" id="envio" >
                            <label class="form-check-label" for="envio">
                                Envios CABA y GBA <br>
                                <small>Compras a partir de $50.000</small>
                            </label>
                          </div>
                          <div>Gratis</div>
                      </div>
                      <div class="d-flex justify-content-between my-3">
                        <div class="form-check ">
                          <input class="form-check-input" type="checkbox" value="" id="envio" >
                          <label class="form-check-label" for="envio">
                              Envios CABA y GBA      
                          </label>
                        </div>
                        <div>Consultar</div>    
                    </div>
                    <div class="d-flex">
                        <input type="text" class="form-control" id="codigopostal" placeholder="Codigo Postal">
                        <button type="submit" class="btn btn__rojo">Calcular</button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">

                        <h4 class="card-title">Total</h4>
                        <span class="cart__numero" id="card-total">${{ $cartTotal }}</span> <!-- Mostrar total -->
                    </div>
                    <hr>
                    <a type="submit" href="" class="btn btn__rojo w-100" >Realizar compra</a>
                </div>
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