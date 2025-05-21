{{-- filepath: c:\Users\LemOwO\carmonaStorage\almacen\resources\views\pedidos\pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .titulo { text-align: center; font-size: 22px; margin-bottom: 20px; }
        .detalle { margin-bottom: 10px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="titulo">Detalle del Pedido #{{ $pedido->id }}</div>
    <div class="detalle"><span class="label">Empleado:</span> {{ $pedido->empleado->nombre }}</div>
    <div class="detalle"><span class="label">Producto:</span> {{ $pedido->producto->nombre }}</div>
    <div class="detalle"><span class="label">Cantidad:</span> {{ $pedido->cantidad }}</div>
    <div class="detalle"><span class="label">Precio Unitario:</span> {{ $pedido->producto->precio }}</div>
    <div class="detalle"><span class="label">Total:</span> {{ $pedido->total }}</div>
    <div class="detalle"><span class="label">Fecha:</span> {{ $pedido->created_at->format('d/m/Y H:i') }}</div>
</body>
</html>
