@extends('layouts.app')
@section('title', 'Detalle Carrito')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <form action="" method="POST">
                @csrf
                <div class="row">
                <div class="form-group col-md-6 ">
                    <label for="nombreApellido">Nombre y Apellido / Razón social*</label>
                    <input type="text" class="form-control mt-2" id="nombreApellido" name="nombreApellido" placeholder="Nombre y Apellido o Razón Social" required>
                </div>
            
                <div class="form-group col-md-6 ">
                    <label for="dniCuit">DNI / CUIT*</label>
                    <input type="text" class="form-control mt-2" id="dniCuit" name="dniCuit" placeholder="DNI o CUIT" required>
                </div>
            
                <div class="form-group col-md-6 mt-4">
                    <label for="email">E-mail*</label>
                    <input type="email" class="form-control mt-2" id="email" name="email" placeholder="Correo electrónico" required>
                </div>
            
                <div class="form-group col-md-6 mt-4">
                    <label for="celular">Celular*</label>
                    <input type="tel" class="form-control mt-2" id="celular" name="celular" placeholder="Número de celular" required>
                </div>
            
                <div class="form-group col-md-6 mt-4">
                    <label for="direccion">Dirección*</label>
                    <input type="text" class="form-control mt-2" id="direccion" name="direccion" placeholder="Dirección completa" required>
                </div>
            
                <div class="form-group col-md-6 mt-4">
                    <label for="localidad">Localidad*</label>
                    <input type="text" class="form-control mt-2" id="localidad" name="localidad" placeholder="Localidad" required>
                </div>
            
                <div class="form-group col-md-6 mt-4">
                    <label for="provincia">Provincia*</label>
                    <input type="text" class="form-control mt-2" id="provincia" name="provincia" placeholder="Provincia" required>
                </div>
            
                <div class="form-group col-md-6 mt-4">
                    <label for="codigoPostal">Código Postal*</label>
                    <input type="text" class="form-control mt-2" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" required>
                </div>
                <div class="col-md-12">

                    <textarea name="texto" class="form-control mt-4" id="" cols="30" rows="10" placeholder="Nota adicional"></textarea>
                </div>
            </div>
               
           
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header cart__header">
                    Total del carrito
                </div>
                <div class="card-body">
                    <h4 class="card-title">Productos</h4>
                    @foreach ($cartItems as $item )
                        <div class="d-flex justify-content-between">
                            <span>{{ $item->name }}</span>
                            <span>x {{ $item->qty }}</span>
                        </div>
                    @endforeach
                    <div class="cart__numero text-right mt-2" id="subtotal">${{ $cartSubotal }}</div>
                    <hr>
                    <h4 class="card-title">Envio</h4>
                    {{ $datos['envio'] }}
                    <hr>
                    <h4 class="card-title">Pago</h4>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metododepago" id="credito" value="credito">
                            <label class="form-check-label" for="credito">Tarjeta de crédito</label> <br>
                            <small class="payment-info" style="display: none" >Mercado Pago</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metododepago" id="transferencia" value="transferencia">
                            <label class="form-check-label" for="transferencia">Transferencia bancaria</label> <br>
                            <small class="payment-info" style="display: none">Cuenta bancaria: [Número de cuenta]</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metododepago" id="efectivo" value="efectivo">
                            <label class="form-check-label" for="efectivo">Pago en efectivo</label> <br>
                            <small class="payment-info" style="display: none">Pago disponible solo en tienda física.</small>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h4>Descuento:</h4>
                        <span id="discountDisplay">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Total con descuento:</h4>
                        <span id="totalDisplay">${{ $cartTotal }}</span>
                    </div>
                    <hr>
                    {{-- <div id="selected-payment-method"></div> --}}
                    <a type="submit" href="" class="btn btn__rojo w-100">Realizar compra</a>
                </div>
            </div>
        </div>
        
       
    </div>
</div>


@endsection
@push('scripts')

<script>
$(document).ready(function() {
    // Función para formatear los números con separadores de miles y decimales
    function formatCurrency(value) {
        return value.toLocaleString('es-AR', { style: 'currency', currency: 'ARS', minimumFractionDigits: 2 });
    }

    // Manejar el cambio de selección de método de pago
    $('input[name="metododepago"]').change(function() {
        const selectedMethod = $(this).val(); // Obtener el método de pago seleccionado

        // Obtener el subtotal desde el DOM y limpiarlo para convertirlo a número
        const subtotal = parseFloat($('#subtotal').text().replace('$', '').replace(/\./g, '').replace(',', '.'));

        let discount = 0;

        // Definir el descuento según el método de pago
        switch (selectedMethod) {
            case 'transferencia':
                discount = subtotal * 0.05; // 5% de descuento
                break;
            case 'efectivo':
                discount = subtotal * 0.1; // 10% de descuento
                break;
            default:
                discount = 0; // Sin descuento para tarjeta de crédito
        }

        // Calcular el total con el descuento aplicado
        const total = subtotal - discount;

        // Mostrar el descuento y el total formateados con separadores de miles y decimales
        $('#discountDisplay').text(formatCurrency(discount));
        $('#totalDisplay').text(formatCurrency(total));

        // Ocultar todos los spans de información de pago y mostrar solo el seleccionado
        $('.payment-info').hide();
        $(this).siblings('.payment-info').show();
    });
});
</script>

@endpush
