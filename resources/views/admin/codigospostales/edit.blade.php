@extends('admin.layouts.master')


@section('content')
<div class=" mt-4">
    <div class="row ">
        <div class="col-md-12">
            <div class="">
                <h2 class="card-header">
                    Editar Código Postal
                </h2>

                <div class="card-body">
                    <form action="{{ route('admin.codigospostales.update', $codigos->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="cp">Código Postal</label>
                            <input type="text" name="cp" id="cp" class="form-control" value="{{ $codigos->cp }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="provincia">Provincia</label>
                            <input type="text" name="provincia" id="provincia" class="form-control" value="{{ $codigos->provincia }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="localidad">Localidad</label>
                            <input type="text" name="localidad" id="localidad" class="form-control" value="{{ $codigos->localidad }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="zona">Zona</label>
                            <select name="zona" id="zona" class="form-control" required>
                                <option value="">Seleccionar Zona</option>
                                @foreach($zonas as $zona)
                                    <option value="{{ $zona->nombre }}" @if($zona->nombre == $codigos->zona) selected @endif>
                                        {{ $zona->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('admin.codigospostales.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
