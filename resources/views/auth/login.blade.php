<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>

    <h1>Iniciar Sesión</h1>

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form action="/login" method="POST">
        @csrf

        <div>
            <label for="email">Correo Electrónico:</label><br>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}" 
                required
            >
        </div>

        <br>

        <div>
            <label for="password">Contraseña:</label><br>
            <input 
                type="password" 
                name="password" 
                id="password" 
                required
            >
        </div>

        <br>

        <button type="submit">Ingresar</button>
    </form>

    <p>
        <a href="/register">Registrarse</a>
    </p>
    <p>
        <a href="/auth/google/redirect">Continuar con Google</a>
    </p>

    <p>
        <a href="/">Volver a la tienda</a>
    </p>

</body>
</html>