<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }
        h1, h2 {
            margin-bottom: 8px;
        }
        .meta {
            font-size: 11px;
            color: #666;
            margin-bottom: 20px;
        }
        .stats {
            margin-bottom: 20px;
        }
        .stats li {
            margin-bottom: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        ul.items-list {
            margin: 0;
            padding-left: 15px;
        }
    </style>
</head>
<body>

    <h1>Panel de Administración — Reporte de Ventas</h1>
    <div class="meta">Generado el: {{ now()->format('d/m/Y H:i') }}</div>

    <h2>Métricas Generales</h2>
    <ul class="stats">
        <li><strong>Ingresos Totales:</strong> ${{ number_format($totalRevenue, 0, ',', '.') }}</li>
        <li><strong>Total de Pedidos:</strong> {{ $totalOrders }}</li>
        <li><strong>Unidades de Longaniza Vendidas:</strong> {{ $itemsSold }}</li>
    </ul>

    <hr>

    <h2>Historial de Pedidos</h2>

    @if ($orders->isEmpty())
        <p>No hay compras registradas todavía.</p>
    @else
        <table>
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
                        <td>{{ $order->user->name }}<br><small>{{ $order->user->email }}</small></td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <ul class="items-list">
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->product->name }} x {{ $item->quantity }}
                                        (${{ number_format($item->price, 0, ',', '.') }})
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