<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Donde Yuyu</title>
</head>
<header>
    @auth
        <span>Hola, {{ Auth::user()->name }}</span>

        @if (Auth::user()->is_admin)
            | <a href="/admin"><strong>Panel Admin</strong></a>
        @endif
        
        <form action="/logout" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    @endauth

    @guest
        <a href="/login">Iniciar Sesión</a> | 
        <a href="/register">Registrarse</a>
    @endguest

    | <a href="/cart">Ver Carrito</a>
</header>

<hr>


<body>
    <h1 style="text-align: center;">Donde Yuyu</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h2>Productos</h2>

    <ul>
        @foreach ($products as $product)
            <li>
                <strong>{{ $product->name }}</strong> - ${{ $product->price }} - Stock: {{ $product->stock }}
                <p>{{ $product->description }}</p>

                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf

                    <label for="qty-{{ $product->id }}">Cantidad:</label>
                    <input 
                        type="number" 
                        name="quantity" 
                        id="qty-{{ $product->id }}" 
                        value="1" 
                        min="1"
                    >

                    <button type="submit">Añadir al Carrito</button>
                </form>
                <br>
            </li>
        @endforeach
    </ul>

</body>
</html>