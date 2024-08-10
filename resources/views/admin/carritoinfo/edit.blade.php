@extends('admin.layouts.master')

@section('content')
    <h1>Editar Carrito Info</h1>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

    <form action="{{ route('admin.carritoinfo.update', $carritoinfo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="desc_mp">Descripción MP:</label>
            <textarea name="desc_mp" id="desc_mp" class="form-control summernote">{{ $carritoinfo->desc_mp }}</textarea>
        </div>

        <div class="form-group">
            <label for="desc_lo">Descripción LO:</label>
            <textarea name="desc_lo" id="desc_lo" class="form-control summernote">{{ $carritoinfo->desc_lo }}</textarea>
        </div>

        <div class="form-group">
            <label for="desc_tb">Descripción TB:</label>
            <textarea name="desc_tb" id="desc_tb" class="form-control summernote">{{ $carritoinfo->desc_tb }}</textarea>
        </div>

        <div class="form-group">
            <label for="desc_fabricante">Descripción Fabricante:</label>
            <textarea name="desc_fabricante" id="desc_fabricante" class="form-control summernote">{{ $carritoinfo->desc_fabricante }}</textarea>
        </div>

        <div class="form-group">
            <label for="desc_minorista">Descripción Minorista:</label>
            <textarea name="desc_minorista" id="desc_minorista" class="form-control summernote">{{ $carritoinfo->desc_minorista }}</textarea>
        </div>

        <div class="form-group">
            <label for="desc_mayorista">Descripción Mayorista:</label>
            <textarea name="desc_mayorista" id="desc_mayorista" class="form-control summernote">{{ $carritoinfo->desc_mayorista }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_retiro_local">Información Retiro Local:</label>
            <textarea name="info_retiro_local" id="info_retiro_local" class="form-control summernote">{{ $carritoinfo->info_retiro_local }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_envio_caba">Información Envío CABA:</label>
            <textarea name="info_envio_caba" id="info_envio_caba" class="form-control summernote">{{ $carritoinfo->info_envio_caba }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_envio_caba2">Información Envío CABA 2:</label>
            <textarea name="info_envio_caba2" id="info_envio_caba2" class="form-control summernote">{{ $carritoinfo->info_envio_caba2 }}</textarea>
        </div>

        <div class="form-group">
            <label for="minimo">Mínimo:</label>
            <textarea name="minimo" id="minimo" class="form-control summernote">{{ $carritoinfo->minimo }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_expreso">Información Expreso:</label>
            <textarea name="info_expreso" id="info_expreso" class="form-control summernote">{{ $carritoinfo->info_expreso }}</textarea>
        </div>

        <div class="form-group">
            <label for="expreso_detalle">Detalle Expreso:</label>
            <textarea name="expreso_detalle" id="expreso_detalle" class="form-control summernote">{{ $carritoinfo->expreso_detalle }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_tc">Información TC:</label>
            <textarea name="info_tc" id="info_tc" class="form-control summernote">{{ $carritoinfo->info_tc }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_tb">Información TB:</label>
            <textarea name="info_tb" id="info_tb" class="form-control summernote">{{ $carritoinfo->info_tb }}</textarea>
        </div>

        <div class="form-group">
            <label for="info_pago_local">Información Pago Local:</label>
            <textarea name="info_pago_local" id="info_pago_local" class="form-control summernote">{{ $carritoinfo->info_pago_local }}</textarea>
        </div>

        <div class="form-group">
            <label for="texto_mp">Texto MP:</label>
            <textarea name="texto_mp" id="texto_mp" class="form-control summernote">{{ $carritoinfo->texto_mp }}</textarea>
        </div>

        <div class="form-group">
            <label for="texto_tb">Texto TB:</label>
            <textarea name="texto_tb" id="texto_tb" class="form-control summernote">{{ $carritoinfo->texto_tb }}</textarea>
        </div>

        <div class="form-group">
            <label for="datos_tb">Datos TB:</label>
            <textarea name="datos_tb" id="datos_tb" class="form-control summernote">{{ $carritoinfo->datos_tb }}</textarea>
        </div>

        <div class="form-group">
            <label for="terminos_detalle">Términos Detalle:</label>
            <textarea name="terminos_detalle" id="terminos_detalle" class="form-control summernote">{{ $carritoinfo->terminos_detalle }}</textarea>
        </div>

        <div class="form-group">
            <label for="terminos">Términos:</label>
            <textarea name="terminos" id="terminos" class="form-control summernote">{{ $carritoinfo->terminos }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
