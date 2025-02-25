@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-wrap p-4 p-md-5">
                <h3 class="mb-4 text-center">Registro a WoodWise</h3>
                <form method="POST" action="{{ route('register') }}" class="signin-form">
                    @csrf

                    <!-- Campo para el nombre -->
                    <div class="form-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Campo para el correo electrónico -->
                    <div class="form-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
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

                    <!-- Confirmación de la contraseña -->
                    <div class="form-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                    </div>

                    <!-- Botón de envío -->
                    <div class="form-group mb-0">
                        <button type="submit" class="form-control btn btn-primary submit px-3">Registrar</button>
                    </div>
                </form>
                <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
