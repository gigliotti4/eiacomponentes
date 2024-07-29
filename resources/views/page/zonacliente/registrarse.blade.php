@extends('layouts.app')
@section('title', 'Registrarse')
@section('content')

<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Registrarse</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('registrarse') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                </div>

                <div class="mb-3">
                    <label for="razon_social" class="form-label">Razón Social</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ old('razon_social') }}" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}" required>
                </div>

                <div class="mb-3">
                    <label for="codigopostal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="codigopostal" name="codigopostal" value="{{ old('codigopostal') }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
        </div>
    </div>
</div>








@endsection