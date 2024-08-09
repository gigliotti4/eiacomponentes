@extends('admin.layouts.master')
@section('content')
<h1 class='mb-4'>Carrito</h1>
  @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <div class="card">
    <div class="card-header">
      Editar contenido
    </div>
    <div class="card-body">

      <form id='formulario' action="{{route('carrito.informacion.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        
        <div class='row'>
          <div class='col-4'>
            <label class='mt-4' for="desc_mp">Descuento Mercado Pago (%)</label>
            <input class='form-control mt-2' type="number" name="desc_mp" {{isset($informacion->desc_mp) ? 'value='.$informacion->desc_mp : ''}}>
          </div>
          
          <div class='col-4'>
            <label class='mt-4' for="desc_tb">Descuento Transferencia Bancaria (%)</label>
            <input class='form-control mt-2' type="number" name="desc_tb" {{isset($informacion->desc_tb) ? 'value='.$informacion->desc_tb : ''}}>
          </div>
          
          <div class='col-4'>
            <label class='mt-4' for="desc_lo">Descuento Pago en Local (%)</label>
            <input class='form-control mt-2' type="number" name="desc_lo" {{isset($informacion->desc_lo) ? 'value='.$informacion->desc_lo : ''}}>
          </div>
          
        </div>
        

        <label class='mt-4' for="info_retiro_local">Info Retiro por Local</label><br>
        <textarea class='summernote-text' id="summernote1" name="info_retiro_local">{!!$informacion->info_retiro_local!!}</textarea>

        <label class='mt-4' for="info_envio_caba">Info Envío a CABA y GBA</label><br>
        <textarea class='summernote-text'  id="summernote2" name="info_envio_caba">{!!$informacion->info_envio_caba!!}</textarea>

        <label class='mt-4' for="info_envio_caba2">Info Envío a CABA y GBA <span style='font-size:14px;font-weight:400;'>(compras a partir de ${{$informacion->minimo}})</span></label><br>
        
        <div class='d-flex' style='align-items:center;'>
          <label for="minimo" style='font-weight:300;width:110px;'>A partir de:</label>
          <input type="number" class='form-control mt-2 mb-2' name='minimo' required value='{{$informacion->minimo}}'>
        </div>
        
        <textarea class='summernote-text mt-2'  id="summernote3" name="info_envio_caba2">{!!$informacion->info_envio_caba2!!}</textarea>

        <label class='mt-4' for="info_expreso">Envíos a todo el país</label><br>
        <div class='d-flex' style='align-items:center;'>
          <label for="expreso_detalle" style='font-weight:300;width:110px;'>Aclaración:</label>
          <input type="text" class='form-control mt-2 mb-2' name='expreso_detalle' required value='{{$informacion->expreso_detalle}}'>
        </div>
        <textarea class='summernote-text'  id="summernote4" name="info_expreso">{!!$informacion->info_expreso!!}</textarea>

        <label class='mt-4' for="info_tc">Info Tarjeta de Crédito</label><br>
        <textarea class='summernote-text'  id="summernote5" name="info_tc">{!!$informacion->info_tc!!}</textarea>

        <label class='mt-4' for="info_tb">Info Transferencia Bancaria</label><br>
        <textarea class='summernote-text'  id="summernote6" name="info_tb">{!!$informacion->info_tb!!}</textarea>

        <label class='mt-4' for="info_pago_local">Info Pago en Local (efectivo)</label><br>
        <textarea class='summernote-text'  id="summernote7" name="info_pago_local">{!!$informacion->info_pago_local!!}</textarea>

        <label class='mt-4' for="daots_tb">Datos para transferencia bancaria</label><br>
        <textarea class='summernote-text'  id="summernote8" name="datos_tb">{!!$informacion->datos_tb!!}</textarea>

        <label class='mt-4' for="texto_mp">Texto que aparece al finalizar una compra</label><br>
        <textarea class='summernote-text'  id="summernote8" name="texto_mp">{!!$informacion->texto_mp!!}</textarea>

        

        {{-- <label class='mt-4' for="texto_tb">Texto que aparece cuando se tiene que procesar el pago por transferencia bancaria</label><br>
        <textarea class='summernote-text'  id="summernote8" name="texto_tb">{!!$informacion->texto_tb!!}</textarea> --}}

        <label class='mt-4' for="terminos">Términos y condiciones de uso</label><br>
        <label for="terminos_detalle" style='font-weight:300;width:110px;padding-top:20px;'>Aclaración:</label>
        <textarea class='summernote-text'  id="summernote10" name="terminos_detalle">{!!$informacion->terminos_detalle!!}</textarea>
        <label for="terminos" style='font-weight:300;width:200px;'>Términos y condiciones</label>
        <textarea class='summernote-text'  id="summernote9" name="terminos">{!!$informacion->terminos!!}</textarea>

        <button type="submit" data-form-id='formulario' class="btn btn-primary submit mt-3" style='float:right;'>Actualizar</button>
      </form>
    </div>
  </div>
  
  
@endsection

@section('script')
<script>
  // Check validity summernote
  document.getElementById('formulario').addEventListener('submit', function(event) {
        var summernoteFields = document.querySelectorAll('.summernote-text');

        for (var i = 0; i < summernoteFields.length; i++) {
            var content = $(summernoteFields[i]).summernote('code').trim(); // Obtener el contenido y eliminar espacios en blanco al inicio y al final
            if (!content) {
                alert('Por favor, complete todos los campos');
                event.preventDefault(); // Detener el envío del formulario
                return;
            }
        }
    });

  // Summernote
  $(document).ready(function() {
      $('.summernote-text').each(function() {
        
        // Inicializar Summernote para este editor
        $(this).summernote({
            placeholder: '',
            tabsize: 2,
            height: 200,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              // ['table', ['table']],
              // ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
  });

</script>
@endsection