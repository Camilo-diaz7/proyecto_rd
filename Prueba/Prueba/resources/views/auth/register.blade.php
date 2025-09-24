@extends('layouts.login')

@section('content')
<div class="login-box">
    <!-- Logo -->
    <div class="login-logo">
        <img src="{{ asset('imagenes/logo1.svg') }}" alt="Logo">
    </div>

    <!-- Título -->
    <h2 class="login-title">{{ __('Registro') }}</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <input id="name"
               type="text"
               placeholder="Nombre"
               class="form-control @error('name') is-invalid @enderror"
               name="name"
               value="{{ old('name') }}"
               required autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <input id="apellido"
               type="text"
               placeholder="Apellido"
               class="form-control @error('apellido') is-invalid @enderror"
               name="apellido"
               value="{{ old('apellido') }}"
               required autofocus>
        @error('apellido')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Tipo de documento -->
        <select id="tipo_documento"
                name="tipo_documento"
                class="form-control @error('tipo_documento') is-invalid @enderror"
                required>
            <option value="">-- Seleccione tipo de documento --</option>
            <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
            <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
            <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
            <option value="PAS" {{ old('tipo_documento') == 'PAS' ? 'selected' : '' }}>Pasaporte</option>
        </select>
        @error('tipo_documento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Número de documento -->
        <input id="numero_documento"
               type="text"
               placeholder="Número de documento"
               class="form-control @error('numero_documento') is-invalid @enderror"
               name="numero_documento"
               value="{{ old('numero_documento') }}"
               required>
        @error('numero_documento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <input id="email"
               type="email"
               placeholder="Correo electrónico"
               class="form-control @error('email') is-invalid @enderror"
               name="email"
               value="{{ old('email') }}"
               required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Contraseña -->
        <input id="password"
               type="password"
               placeholder="Contraseña"
               class="form-control @error('password') is-invalid @enderror"
               name="password"
               required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Confirmar Contraseña -->
        <input id="password-confirm"
               type="password"
               placeholder="Confirmar contraseña"
               class="form-control"
               name="password_confirmation"
               required>

        <!-- Botón -->
        <button type="submit" class="btn-red">
            {{ __('Registrar') }}
        </button>
        <a href="{{ route('login') }}" class="btn-gray">
            {{ __('Cancelar') }}
        </a>
    </form>
</div>
@endsection
