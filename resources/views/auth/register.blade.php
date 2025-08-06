@extends('layouts.template-frontend')

@section('contenido')
<div class="register-form">
    <h2>Registrarse</h2>

    <form method="POST" action="{{ route('register.store') }}">

        @csrf

        <label>Nombre:</label>
        <input type="text" name="name" required>

        <label>Correo electrónico:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <label>Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Registrarse</button>
    </form>
</div>
@endsection
