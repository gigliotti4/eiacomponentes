<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de tu Carrito</title>
</head>
<body>
    <h2>Detalles de tu Carrito</h2>
    
    <p><strong>Nombre del cliente:</strong> {{ $cliente->name }}</p>
    <p><strong>Email del cliente:</strong> {{ $cliente->email }}</p>
    <p><strong>Dirección del cliente:</strong> {{ $cliente->direccion }}</p>

    @if($role === 'fabricante')
        <p>fabricante</p>
    @elseif($role === 'mayorista')
        <p>mayorista</p>
    @elseif($role === 'minorista')
        <p>minorista</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td><img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" style="width: 50px;"></td>
                <td>{{ $item->options->codigo }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ @$item->options->colores['color_seleccionado'] }}</td>
                <td>{{ $item->qty }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>¡Gracias por tu compra!</p>
</body>
</html>