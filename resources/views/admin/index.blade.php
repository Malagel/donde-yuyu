<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
</head>
<body>

    <header>
        <span>Administrador: {{ Auth::user()->name }}</span> | 
        <a href="/">Ir a la tienda</a>
    </header>

    <hr>

    <h1>Estadísticas</h1>

    <div style="margin-bottom: 15px;">
        <a href="/admin/export/csv"><button type="button">Descargar Excel (CSV)</button></a>
        <a href="/admin/export/pdf"><button type="button">Descargar Reporte PDF</button></a>
    </div>
    
    <ul>
        <li><strong>Ingresos Totales:</strong> ${{ number_format($totalRevenue, 0, ',', '.') }}</li>
        <li><strong>Total de Pedidos:</strong> {{ $totalOrders }}</li>
        <li><strong>Unidades de Longaniza Vendidas:</strong> {{ $itemsSold }}</li>
    </ul>

    <hr>

    <h2>Historial de Pedidos</h2>

    @if ($orders->isEmpty())
        <p>No hay compras registradas todavía.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th># Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Detalle de Productos</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->product->name }} x {{ $item->quantity }} 
                                        (${{ number_format($item->price, 0, ',', '.') }} c/u)
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>${{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>