@extends('admin.layouts.master')

@section('content')
    <h1>Cómo Comprar</h1>
    <a href="{{ route('admin.comprar.create') }}" class="btn btn-success mb-3">Crear nuevo</a>
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
                {{-- <th>Icono</th>
                <th>Número</th> --}}
                <th>Texto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comprar as $item)
                <tr>
                    <td>{{ $item->orden }}</td>
                    {{-- <td><img src="{{ asset('storage/' . $item->icono) }}" width="50"></td>
                    <td><img src="{{ asset('storage/' . $item->numero) }}" width="50"></td> --}}
                    <td>{!! $item->texto !!}</td>
                    <td>
                        <a href="{{ route('admin.comprar.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.comprar.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
