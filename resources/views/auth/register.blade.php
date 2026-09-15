<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
</head>
<body>

    <h1>Registro de Usuario</h1>

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form action="/register" method="POST">
        @csrf

        <div>
            <label for="name">Nombre:</label><br>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                required
            >
        </div>

        <br>

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

        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label><br>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                required
            >
        </div>

        <br>

        <button type="submit">Registrarse</button>
    </form>

    <p>
        <a href="/login">¿Ya tienes cuenta? Inicia sesión aquí</a><br>
        <a href="/">Volver a la tienda</a>

    </p>

</body>
</html>