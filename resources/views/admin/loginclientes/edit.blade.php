@extends('admin.layouts.master')

@section('content')
<h3>Editar Cliente</h3>
<form method="POST" action="{{ route('admin.loginclientes.update', $cliente->id) }}">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="form-group col-md-6">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $cliente->name }}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $cliente->username }}" required>
        </div>
  

        <div class="form-group col-md-6">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option value="fabricante" {{ $cliente->role == 'fabricante' ? 'selected' : '' }}>Fabricante</option>
                <option value="minorista" {{ $cliente->role == 'minorista' ? 'selected' : '' }}>Minorista</option>
                <option value="mayorista" {{ $cliente->role == 'mayorista' ? 'selected' : '' }}>Mayorista</option>
            </select>
        </div>
        
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email }}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="razon_social">razon_social</label>
            <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $cliente->razon_social }}" required>
        </div>
   
        <div class="form-group col-md-6">
            <label for="codigopostal">codigopostal</label>
            <input type="text" class="form-control" id="codigopostal" name="codigopostal" value="{{ $cliente->codigopostal }}" required>
        </div>
   
        <div class="form-group col-md-6">
            <label for="telefono">telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required>
        </div>
   
        <div class="form-group col-md-6">
            <label for="direccion">direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}" required>
        </div>
   
        <div class="form-group col-md-6">
            <label for="dni">dni</label>
            <input type="text" class="form-control" id="dni" name="dni" value="{{ $cliente->dni }}" required>
        </div>
   

        <div class="form-group col-md-6">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Dejar en blanco para mantener la misma contraseña.</small>
        </div>
        <div class="form-group col-md-6">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
@endsection
