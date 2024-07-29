@extends('admin.layouts.master')

@section('content')

<a href="{{ route('admin.categorias.create') }}" class="btn btn-success mb-5">Nuevo Categoria </a>

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
            <th>Orden</th>
            <th>Titulo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
        <tr>
            <td>{{ $categoria->orden }}</td>
            <td>{{ $categoria->nombre }}</td>
            <td>
                <a class="btn btn-warning" href="{{ route('admin.categorias.edit', ['id' => $categoria->id]) }}" role="button"><i class="fas fa-edit"></i></a>
                <form action="{{ route('admin.categorias.destroy', ['id' => $categoria->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-item"><i class="far fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

