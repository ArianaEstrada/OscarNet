@extends('layouts.app')

@section('title', 'Configuración del Router')

@section('content')
    <h1>Panel de Configuración del Router</h1>

    @if(session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <h2>Cambiar Configuración del Router</h2>
    <form method="POST" action="{{ route('router.config.update') }}">
    @csrf  <!-- This is CRUCIAL -->
    <div>
        <label for="ssid">Nuevo SSID:</label>
        <input type="text" id="ssid" name="ssid" required>
    </div>
    <div>
        <label for="password">Nueva Contraseña:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Guardar Configuración</button>
</form>


    <h2>Control del LED (Ejemplo)</h2>
    <form method="POST" action="{{ url('/config/led') }}">
        @csrf
        <button type="submit" name="color" value="on" class="green">Encender LED</button>
        <button type="submit" name="color" value="off" class="off">Apagar LED</button>
    </form>
@endsection
