@extends('layouts.app')
@section('title', 'Mayorista')
@section('content')

<div class="container my-5">
 
    
    <span class="titulo__secciones">Solicitud para mayoristas</span>

  
    <div class="row justify-content-center ">
      <form id="presupuesto-form" method="POST" class="my-3">
        @csrf
        <input type='hidden' name='g-recaptcha-response' id='g-recaptcha-response'>
        <div class="row ">

          <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Nombre*</label>
              <input type="text" class="form-control" id="name" name="name" required>
          </div>
      
          <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Correo Electrónico *</label>
              <input type="email" class="form-control" id="email" name="email" required>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Teléfono *</label>
              <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="company" class="form-label">Empresa </label>
              <input type="text" class="form-control" id="company" name="company" required>
          </div>

        </div>

  

        <div class="row mt-3">
          <div class="col-md-12 mb-3">
              <label for="message" class="form-label">Mensaje</label>
              <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
          </div>
        </div>
            <div class="col-md-6 mb-3 float-right">
              
              <button type="submit" class="btn btn__rojo mt-5" onclick="onClick(event)">Enviar consulta</button>
            </div>
    </form>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  $(document).ready(function() {
      $('#presupuesto-form').on('submit', function(e) {
          e.preventDefault(); // Evita la sumisión del formulario por defecto
  
          // Serializa los datos del formulario
          var formData = new FormData(this);
  
          $.ajax({
              type: 'POST',
              url: "{{ route('presupuesto.send') }}",
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                  Swal.fire({
                      icon: 'success',
                      title: '¡Presupuesto Enviado!',
                      text: response.message,
                  });
                  $('#presupuesto-form')[0].reset();
              },
              error: function(response) {
                  var errors = response.responseJSON.errors;
                  var errorsHtml = '<ul>';
                  $.each(errors, function(key, value) {
                      errorsHtml += '<li>' + value[0] + '</li>';
                  });
                  errorsHtml += '</ul>';
  
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      html: 'Hubo un error al enviar el presupuesto:<br>' + errorsHtml,
                  });
              }
          });
      });
  });

  function onClick(e) {
        e.preventDefault();
        
        grecaptcha.ready(function() {
          grecaptcha.execute('6LeZ37spAAAAABu2hJrIno55hRmQfChQeW-7cNEW', {action: 'submit'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              form = document.getElementById('presupuesto-form')
              if(form.checkValidity()){
                   var boton = e.target;
                boton.innerText = 'Enviando...';
                boton.classList.add('green-btn')
                boton.classList.remove('green-btn-inverse')
                form.submit()
              } else {
                mensajes = document.querySelectorAll('.result')
                mensajes.forEach(function(msj) {
                    msj.innerText = 'Hay campos obligatorios sin completar'
                    msj.style.color = 'red';
                })
              }
              
          });
        });
      }
</script>


@endpush
