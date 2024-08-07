@extends('admin.layouts.master')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.loginclientes.create') }}" class="btn btn-success">Crear Cliente</a>
</div>

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('danger'))
    <div class="alert alert-danger">
        {{ session()->get('danger') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nombre de Usuario</th>
            <th>Rol</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->name }}</td>
                <td>{{ $cliente->username }}</td>
                <td>{{ $cliente->role }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                    <a href="{{ route('admin.loginclientes.edit', $cliente->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.loginclientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
