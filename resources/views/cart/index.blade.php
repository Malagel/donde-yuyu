@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h1 class="h3 mb-0">Carrito de Compras</h1>
    <a href="/" class="btn btn-outline-secondary btn-sm">&larr; Seguir comprando</a>
</div>

@if (empty($cart))
    <div class="card shadow-sm text-center p-5">
        <div class="card-body">
            <p class="text-muted fs-5 mb-3">Tu carrito está vacío.</p>
            <a href="/" class="btn btn-dark">Ver Catálogo</a>
        </div>
    </div>
@else
    <div class="card shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col" class="text-center">Cantidad</th>
                        <th scope="col" class="text-end pe-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item['quantity'] }}</td>
                            <td class="text-end pe-4 fw-bold">
                                ${{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center p-3">
            <form action="/cart/clear" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    Vaciar Carrito
                </button>
            </form>

            <div class="text-end">
                <span class="text-muted small me-2">Total:</span>
                <span class="fs-4 fw-bold text-dark">${{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <form action="/cart/checkout" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-success btn-lg px-4 fw-semibold">
                Confirmar y Comprar
            </button>
        </form>
    </div>
@endif
@endsection