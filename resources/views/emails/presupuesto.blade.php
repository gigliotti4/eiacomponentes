<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud de Presupuesto</title>
</head>
<body>
    <h2>Nueva Solicitud de Presupuesto</h2>
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Correo Electrónico:</strong> {{ $data['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
    <p><strong>Empresa:</strong> {{ $data['company'] }}</p>
    <p><strong>Producto a Consultar:</strong> {{ $data['product'] }}</p>
    <p><strong>Servicio:</strong> {{ $data['service'] }}</p>
    <p><strong>Detalles del Presupuesto:</strong> {{ $data['message'] }}</p>
</body>
</html>
