<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .titulo { text-align: center; font-size: 22px; margin-bottom: 20px; }
        .detalle { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="titulo">Detalle del Pedido #{{ $pedido->id }}</div>
    <div class="detalle"><strong>Empleado:</strong> {{ $pedido->empleado->nombre }}</div>
    <div class="detalle"><strong>Producto:</strong> {{ $pedido->producto->nombre }}</div>
    <div class="detalle"><strong>Cantidad:</strong> {{ $pedido->cantidad }}</div>
    <div class="detalle"><strong>Precio Unitario:</strong> {{ $pedido->producto->precio }}</div>
    <div class="detalle"><strong>Total:</strong> {{ $pedido->total }}</div>
    <div class="detalle"><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</div>
</body>
</html>
