<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de tu Compra</title>
</head>
<body>
    <h1>¡Gracias por tu compra, {{ $order->nombre_apellido }}!</h1>

    <p>Detalles del pedido:</p>
    <ul>
        <li><strong>DNI/CUIT:</strong> {{ $order->dni_cuit }}</li>
        <li><strong>Email:</strong> {{ $order->email }}</li>
        <li><strong>Celular:</strong> {{ $order->celular }}</li>
        <li><strong>Dirección:</strong> {{ $order->direccion }}</li>
        <li><strong>Localidad:</strong> {{ $order->localidad }}</li>
        <li><strong>Provincia:</strong> {{ $order->provincia }}</li>
        <li><strong>Código Postal:</strong> {{ $order->codigo_postal }}</li>
        <li><strong>Método de Pago:</strong> {{ $order->metodo_pago }}</li>
        <li><strong>Subtotal:</strong> ${{ $order->subtotal }}</li>
        <li><strong>Descuento:</strong> ${{ $order->descuento }}</li>
        <li><strong>Total:</strong> ${{ $order->total }}</li>
    </ul>

    <p>Items en el carrito:</p>
    <ul>
        @foreach (json_decode($order->cart_items, true) as $item)
            <li>{{ $item['name'] }} (Cantidad: {{ $item['qty'] }}) - ${{ $item['price'] }}</li>
        @endforeach
    </ul>

    <p>¡Gracias por confiar en nosotros!</p>
</body>
</html>
