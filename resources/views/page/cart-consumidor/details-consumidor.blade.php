@extends('layouts.app')
@section('title', 'Detalle Carrito')

@section('content')


                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('danger'))
                <div class="alert alert-danger">
                    {{ session()->get('danger') }}
                </div>
            @endif

<form action="{{ route('processCheckout2') }}" method="POST"> <!-- Asegúrate de tener la ruta correcta -->
    @csrf
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
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
                <div class="card-header cart__header">Total del carrito</div>
                <div class="card-body">
                    <h4 class="card-title">Productos</h4>
                    <!-- Ciclo para mostrar los items del carrito -->
                    @foreach ($cartItems as $item)
                        <div class="d-flex justify-content-between">
                            <span>{{ $item->name }}</span>
                            <span>({{ is_array($item->options->colores) ? implode(', ', $item->options->colores) : $item->options->colores }})</span> 
                            <span>x {{ $item->qty }}</span>
                        </div>
                    @endforeach
                 

                    <div class="cart__numero text-right mt-2" id="subtotal">${{ @$cartSubtotal= number_format((float) $cartSubtotal, 2, ',', '.'); }}</div>
                    <hr>
                    <h4 class="card-title">Envio</h4>
                    {{ $datos['envio'] }}
                    <input type="hidden" name="envio" value="{{$datos['envio']}}">
                    <hr>
                    <h4 class="card-title">Pago</h4>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metododepago" id="credito" value="credito">
                            <label class="form-check-label" for="credito">Tarjeta de crédito</label> <br>
                            <small class="payment-info" id="payment-info-credito" style="display: none">Mercado Pago</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metododepago" id="transferencia" value="transferencia">
                            <label class="form-check-label" for="transferencia">Transferencia bancaria (-5%)</label> <br>
                            <small class="payment-info" id="payment-info-transferencia" style="display: none">Cuenta bancaria: [Número de cuenta]</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metododepago" id="efectivo" value="efectivo">
                            <label class="form-check-label" for="efectivo">Pago en efectivo (-10%)</label> <br>
                            <small class="payment-info" id="payment-info-efectivo" style="display: none">Pago disponible solo en tienda física.</small>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h4>Descuento:</h4>
                        <span id="discountDisplay">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Costo de Envio:</h4>
                        <span id="costoEnvio">${{ $costoEnvio= number_format((float) $costoEnvio, 2, ',', '.'); }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Total:</h4>
                        <span id="totalDisplay">${{ @$cartTotal= number_format((float) $cartTotal, 2, ',', '.'); }}</span>
                    </div>
                    <div class="wallet_container" id="wallet_container" disabled style="display: none;"></div>
                  
                    <button type="submit" id="button-transferencia"  class="btn btn__rojo w-100" style="display: none;">Realizar transferencia</button>
                    <button type="submit" id="button-efectivo"  class="btn btn__rojo w-100" style="display: none;">Pagar en efectivo</button>
                </div>
            </div>
        </div>
</div>
</div>
</form>

@endsection
@push('scripts')
<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
// Inicialización de MercadoPago
const mp = new MercadoPago('{{ env('MP_PUBLIC_KEY') }}', { locale: 'es-AR' });

mp.bricks().create("wallet", "wallet_container", {
    initialization: { preferenceId: "{{ $payment->id }}" },
    customization: {
        visual: {
            buttonBackground: 'black',
            borderRadius: '16px',
        },
    },
});

// Obtener referencias de elementos
const paymentMethods = document.getElementsByName('metododepago');
const buttonTransferencia = document.getElementById('button-transferencia');
const buttonEfectivo = document.getElementById('button-efectivo');
const walletContainer = document.getElementById('wallet_container');
const paymentInfoElements = document.querySelectorAll('.payment-info');
const discountDisplay = document.getElementById('discountDisplay');
const totalDisplay = document.getElementById('totalDisplay');
const subtotalElement = document.getElementById('subtotal');
const costoEnvioElement = document.getElementById('costoEnvio'); // Para obtener el costo de envío

// Función para formatear moneda
function formatCurrency(value) {
    return value.toLocaleString('es-AR', { style: 'currency', currency: 'ARS', minimumFractionDigits: 2 });
}

// Función para calcular el descuento y total
function updateTotal(selectedMethod) {
    // Obtener el subtotal y limpiarlo para convertirlo en número
    const subtotal = parseFloat(subtotalElement.textContent.replace('$', '').replace(/\./g, '').replace(',', '.'));
    
    // Obtener el costo de envío, limpiarlo y convertirlo en número
    const costoEnvio = parseFloat(costoEnvioElement.textContent.replace('$', '').replace(/\./g, '').replace(',', '.'));

    let discount = 0;

    // Aplicar descuento según método de pago
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

    // Calcular el total considerando el costo de envío
    const total = (subtotal + costoEnvio) - discount;

    // Mostrar el descuento y total formateados
    discountDisplay.textContent = formatCurrency(discount);
    totalDisplay.textContent = formatCurrency(total);
}

// Event listener para cambio de método de pago
paymentMethods.forEach(paymentMethod => {
    paymentMethod.addEventListener('change', function() {
        const selectedMethod = this.value;

        // Ocultar todos los elementos
        walletContainer.style.display = 'none';
        buttonTransferencia.style.display = 'none';
        buttonEfectivo.style.display = 'none';
        paymentInfoElements.forEach(info => info.style.display = 'none');

        // Mostrar elementos correspondientes al método seleccionado
        switch (selectedMethod) {
            case 'credito':
                walletContainer.style.display = 'block';
                document.getElementById('payment-info-credito').style.display = 'block';
                break;
            case 'transferencia':
                buttonTransferencia.style.display = 'block';
                document.getElementById('payment-info-transferencia').style.display = 'block';
                break;
            case 'efectivo':
                buttonEfectivo.style.display = 'block';
                document.getElementById('payment-info-efectivo').style.display = 'block';
                break;
        }

        // Actualizar descuento y total
        updateTotal(selectedMethod);
    });
});

</script>
@endpush
