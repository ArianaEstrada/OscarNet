@extends('layouts.app')

@section('title', 'Inicio de Sesión')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-wrap p-4 p-md-5">
                <h3 class="mb-4 text-center">Iniciar Sesión</h3>
                <form method="POST" action="{{ route('login') }}" class="signin-form">
                    @csrf

                    <!-- Campo para el correo electrónico -->
                    <div class="form-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Campo para la contraseña -->
                    <div class="form-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Botón de ingreso -->
                    <div class="form-group mb-3">
                        <button type="submit" class="form-control btn btn-primary submit px-3">Ingresar</button>
                    </div>
                </form>
                <p class="text-center mt-3">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
