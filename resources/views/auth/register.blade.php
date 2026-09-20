@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="col-12 col-md-6 col-lg-4">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h1 class="h4 text-center mb-4">Crear Cuenta</h1>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 small" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="/register" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        Registrarse
                    </button>
                </form>

                <div class="text-center my-3 text-muted small"></div>

                <a href="/auth/google/redirect" class="btn btn-outline-danger w-100">
                    Continuar con Google
                </a>

                <div class="text-center mt-4 small">
                    ¿Ya tienes cuenta? <a href="/login" class="text-decoration-none">Inicia sesión aquí</a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection