<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito</title>
</head>
<body>
    <p><a href="/">&larr; Seguir comprando</a></p>

    <h1>Carrito de Compras</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if (empty($cart))
        <p>Tu carrito está vacío.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ $item['price'] * $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: ${{ $total }}</h3>

        <div style="display: flex; gap: 12px; margin-top: 16px;">   
            <form action="/cart/checkout" method="POST">
                @csrf
                <button type="submit">Confirmar y Comprar</button>
            </form>

            <form action="/cart/clear" method="POST">
                @csrf
                <button type="submit">Vaciar Carrito</button>
            </form>
        </div>
    @endif

</body>
</html>