@extends('admin.layouts.master')

@section('content')
<a href="{{ route('admin.colores.create') }}" class="btn btn-success mb-5">Nuevo Color</a>

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
            <th>Color</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colores as $color)
            <tr>
                <td>{{ $color->orden }}</td>
                <td>{{ $color->nombre }}</td>
                <td><input type="color" value="{{ $color->color }}" disabled></td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.colores.edit', $color->id) }}" role="button"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.colores.destroy', $color->id) }}" method="POST" style="display: inline;">
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
