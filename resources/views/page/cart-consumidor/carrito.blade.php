@extends('layouts.app')
@section('title', 'Carrito de compra')

@section('content')


<div class="container my-5">

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header cart__header">
                    Carrito
                </div>
                @if($cartItems->isEmpty())
                <h3 class="p-4 text-center">Tu carrito está vacío.</h3>
                @else
                @foreach($cartItems as $item)
                <div class="card-body d-flex align-items-center mb-3">
                    <div class="col-md-2">
                        <img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" class="img-fluid" style="max-width: 90px;">
                    </div>
                    <div class="col-md-4">  
                        <h4 class="cart__categoria">{{ $item->options->categoria }}</h4>
                        <h4 class="cart__titulo">{{ $item->name }}</h4>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="wrapper-producto mb-2">
                                <button class="plusminus" onclick="handleMinus('{{ $item->rowId }}')">-</button>
                                <input type="number" class="form-control text-center border-0 form-control-sm cantidad-input{{ $item->rowId }}" name="qty" pattern="[0-9]+" title="Ingrese solo números" inputmode="numeric" min="1" value="{{ $item->qty }}" required>
                                <button class="plusminus" onclick="handlePlus('{{ $item->rowId }}')">+</button>
                            </div>
                            <div class="ms-2">
                                {{ @$item->options->colores['color_seleccionado'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="d-flex align-items-center justify-content-around">
                            <p class="cart__precio mt-2">${{ number_format($item->price, 2, ',', '.') }}</p>
                        
                            <img src="{{ asset('img/remove.png') }}" class="remove-item" data-rowid="{{ $item->rowId }}" style="cursor: pointer; width: 24px;">
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <a href="{{ route('categorias') }}" class="btn btn__white mt-3">< Seguir comprando</a>   
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-header cart__header">
                    Total del carrito
                </div>
                <div class="card-body">
                    <form action="">
                        @csrf
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Subtotal</h4>
                        <span class="cart__numero" id="subtotal" >${{ $cartSubotal }}</span> <!-- Mostrar subtotal -->
                    </div>
                    <h4 class="card-title">Envio</h4>
                    <div class="d-flex my-3 justify-content-between">
                        <div class="form-check ">
                            <input class="form-check-input envio-opcion" type="radio" data-texto='Retiro en local' data-costo="0" name="flexRadioDefault" >
                                <div class='carrito-total-texto'>Retiro en local</div>
                        </div>
                        <div>Gratis</div>
                    </div>
                      <div class="d-flex my-3 justify-content-between">
                          <div class="form-check ">
                            <input class="form-check-input" type="radio" value=""  data-texto='Envíos CABA y GBA' data-costo="0" name="flexRadioDefault" >
                            <label class="form-check-label" for="envio">
                                Envios CABA y GBA <br>
                                <small>Compras a partir de $50.000</small>
                            </label>
                          </div>
                          <div>Gratis</div>
                      </div>
                    
                      <div class="d-flex justify-content-between my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="envioCheckbox" name="flexRadioDefault">
                            <label class="form-check-label" for="envioCheckbox">
                                Envíos CABA y GBA      
                            </label>
                        </div>
                        <div>Consultar</div>    
                    </div>
                    <div id="codigoPostalContainer" style="display: none;">
                        <input type="text" class="form-control my-3" id="codigopostal" placeholder="Código Postal">
                        <button type="submit" class="btn btn__rojo">Calcular</button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">

                        <h4 class="card-title">Total</h4>
                        <span class="cart__numero" id="card-total">${{ $cartTotal }}</span> <!-- Mostrar total -->
                    </div>
                    <hr>
                    <a type="submit" href="{{route('details.consumidor' )}}" class="btn btn__rojo w-100" >Realizar compra</a>
                </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
@push('scripts')

<script>
    document.getElementById('envioCheckbox').addEventListener('change', function() {
        var codigoPostalContainer = document.getElementById('codigoPostalContainer');
        if (this.checked) {
            codigoPostalContainer.style.display = 'block'; // Mostrar el contenedor
        } else {
            codigoPostalContainer.style.display = 'none'; // Ocultar el contenedor
        }
    });
</script>
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
        url: "{{ route('cart.update.consumidor') }}",
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
            url: "{{ route('cart.remove.consumidor') }}",
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