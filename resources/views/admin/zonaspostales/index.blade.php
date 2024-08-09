@extends('admin.layouts.master')

@section('content')
 <a href="{{ route('admin.zonaspostales.create') }}" class="btn btn-success mb-5">Nueva zona</a> 
<table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Costo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($zonas as $zona)
        <tr>
          <td>{{$zona->nombre}}</td>
          <td>{{$zona->costo}}</td>
          <td>
            <a class="btn btn-warning" href="{{ route('admin.zonaspostales.edit', $zona->id) }}" role="button"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.zonaspostales.destroy', $zona->id) }}" method="POST" style="display: inline;">
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