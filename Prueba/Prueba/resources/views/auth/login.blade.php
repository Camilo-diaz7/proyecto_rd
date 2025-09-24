@extends('layouts.login')

@section('content')
<div class="login-box">

    <!-- Logo -->
    <div class="login-logo">
        <img src="{{ asset('imagenes/logo1.svg') }}" alt="Logo">
    </div>

    <!-- Título -->
    <div class="login-title">Inicio de sesión</div>

    <!-- Formulario -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Número de documento -->
        <input id="numero_documento"
               type="text"
               class="form-control @error('numero_documento') is-invalid @enderror"
               name="numero_documento"
               value="{{ old('numero_documento') }}"
               required
               autofocus
               placeholder="Numero de documento">

        @error('numero_documento')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- Contraseña -->
        <input id="password"
               type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password"
               required
               placeholder="Contraseña">

        @error('password')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- Botones -->
        <button type="submit" class="btn-red">Aceptar</button>
        <a href="{{ url('/') }}" class="btn-gray d-block text-center">Cancelar</a>
    </form>
</div>
@endsection
