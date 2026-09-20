@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div>
        <h1 class="h3 mb-1">Panel de Administración</h1>
        <span class="text-muted small">Administrador: <strong class="text-dark">{{ Auth::user()->name }}</strong></span>
    </div>
    
    <div class="d-flex gap-2">
        <a href="/admin/products" class="btn btn-outline-dark btn-sm">
            Gestionar Productos (por hacer)
        </a>
        <a href="/" class="btn btn-outline-secondary btn-sm">
            &larr; Ir a la tienda
        </a>
    </div>
</div>

<h2 class="h5 mb-3">Estadísticas Yuyú</h2>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    <div class="col">
        <div class="card shadow-sm border-0 bg-white h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase fw-bold">Ingresos Totales</span>
                <h3 class="fs-3 fw-bold text-success mt-2 mb-0">${{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 bg-white h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase fw-bold">Total de Pedidos</span>
                <h3 class="fs-3 fw-bold text-primary mt-2 mb-0">{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 bg-white h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase fw-bold">Unidades Vendidas</span>
                <h3 class="fs-3 fw-bold text-dark mt-2 mb-0">{{ $itemsSold }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mb-4">
    <a href="/admin/export/csv" class="btn btn-outline-success btn-sm">
        Descargar CSV 
    </a>
    <a href="/admin/export/pdf" class="btn btn-outline-danger btn-sm">
        Descargar PDF
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h2 class="h5 mb-0 fw-bold">Historial de Pedidos</h2>
    </div>

    @if ($orders->isEmpty())
        <div class="card-body text-center py-5">
            <p class="text-muted mb-0">No hay compras registradas todavía.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4"># Pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Detalle de Productos</th>
                        <th scope="col">Total</th>
                        <th scope="col" class="text-center pe-4">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $order->user->name }}</div>
                                <div class="text-muted small">{{ $order->user->email }}</div>
                            </td>
                            <td class="small text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <ul class="list-unstyled mb-0 small">
                                    @foreach ($order->items as $item)
                                        <li class="py-1 border-bottom border-light">
                                            <span class="fw-semibold">{{ $item->product->name }}</span> 
                                            <span class="text-muted">× {{ $item->quantity }}</span> 
                                            <span class="text-secondary">(${{ number_format($item->price, 0, ',', '.') }} c/u)</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold">${{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="text-center pe-4">
                                <span class="badge bg-secondary text-uppercase px-2 py-1 small">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection