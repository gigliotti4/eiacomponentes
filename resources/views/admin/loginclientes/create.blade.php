@extends('admin.layouts.master')

@section('content')
<h3>Nuevo Cliente</h3>
<form method="POST" action="{{ route('admin.loginclientes.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="role">Tipo de cliente</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Seleccionar rol</option>
                    <option value="fabricante">Fabricante</option>
                    <option value="minorista">Minorista</option>
                    <option value="mayorista">Mayorista</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="codigopostal">codigo postal</label>
                <input type="text" class="form-control" id="codigopostal" name="codigopostal" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="dni">Dni</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="razon_social">razon social</label>
                <input type="text" class="form-control" id="razon_social" name="razon_social" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-success mt-3">Agregar</button>
</form>
@endsection
