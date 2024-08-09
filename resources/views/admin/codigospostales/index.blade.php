@extends('admin.layouts.master')

@section('content')
{{-- <a href="{{ route('admin.zonapostales.create') }}" class="btn btn-success mb-5">Nueva zona</a> --}}

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

<input type="text" class="form-control " id="searchInput" placeholder="Buscar...">
<table class="table">
    <thead>
        <tr>
            <th>cp</th>
            <th>provincia</th>
            <th>localidad</th>
            <th>zona</th>
            
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($codigos as $codigo)
            <tr>
                <td>{{$codigo->cp}}</td>
                <td>{{ucfirst($codigo->provincia)}}</td>
                <td>{{$codigo->localidad}}</td>
                <td>{{$codigo->zona}}</td>
               
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.codigospostales.edit', $codigo->id) }}" role="button"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.codigospostales.destroy', $codigo->id) }}" method="POST" style="display: inline;">
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
@push('scripts')
<script>
const searchInput = document.getElementById('searchInput');
const table = document.querySelector('.table');
const tableRows = table.querySelectorAll('tbody tr');

searchInput.addEventListener('keyup', function() {
  const searchTerm = this.value.toLowerCase();

  tableRows.forEach(row => {
    const cp = row.cells[0].textContent.toLowerCase();
    const provincia = row.cells[1].textContent.toLowerCase();
    const localidad = row.cells[2].textContent.toLowerCase();
    const zona = row.cells[3].textContent.toLowerCase();

    if (cp.includes(searchTerm) || provincia.includes(searchTerm) || localidad.includes(searchTerm) || zona.includes(searchTerm)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});

</script>


@endpush