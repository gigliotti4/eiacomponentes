@extends('layouts.app')
@section('title', 'Solicitud de presupuesto')
@section('content')
<div class="bg__breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Solicitud de presupuesto</li>
            </ol>
            <span class="breadcrumb-titulo">Solicitud de presupuesto</span>
          </nav>
    </div>
</div>

<div class="container my-5">
  <div class="contenedor">
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
        <path d="M17.4999 18.9583C21.527 18.9583 24.7916 15.6937 24.7916 11.6667C24.7916 7.63959 21.527 4.375 17.4999 4.375C13.4728 4.375 10.2083 7.63959 10.2083 11.6667C10.2083 15.6937 13.4728 18.9583 17.4999 18.9583Z" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M29.1666 30.625C29.1666 27.5308 27.9374 24.5634 25.7495 22.3755C23.5616 20.1875 20.5941 18.9584 17.4999 18.9584C14.4057 18.9584 11.4383 20.1875 9.25034 22.3755C7.06241 24.5634 5.83325 27.5308 5.83325 30.625" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span class="titulo__presupuesto">Datos Personales</span>
  </div>
  
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

        <style>
          
        </style>

        <div class="contenedor mt-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
            <path d="M19.5416 2.91663H8.74992C7.97637 2.91663 7.2345 3.22392 6.68752 3.7709C6.14054 4.31788 5.83325 5.05974 5.83325 5.83329V29.1666C5.83325 29.9402 6.14054 30.682 6.68752 31.229C7.2345 31.776 7.97637 32.0833 8.74992 32.0833H26.2499C27.0235 32.0833 27.7653 31.776 28.3123 31.229C28.8593 30.682 29.1666 29.9402 29.1666 29.1666V18.375" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.91675 8.75H8.75008" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.91675 14.5834H8.75008" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.91675 20.4166H8.75008" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.91675 26.25H8.75008" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M26.8333 3.79166C27.4412 3.39929 28.1652 3.22706 28.8847 3.30369C29.6041 3.38032 30.2756 3.70117 30.7872 4.21278C31.2988 4.72439 31.6197 5.39586 31.6963 6.11532C31.7729 6.83478 31.6007 7.55877 31.2083 8.16666L23.3333 16.0417L17.5 17.5L18.9583 11.6667L26.8333 3.79166Z" stroke="#7CB420" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span class="titulo__presupuesto">Consulta</span>
        </div>
        <div class="row">

          <div class="col-md-6 mb-3">
            <label for="product" class="form-label">Producto a consultar *</label>
            <div class="input-group">
                <select class="form-select" id="product" name="product" required>
                    <option value="cintas">Cintas transportadoras</option>
                    <option value="repuesto">Repuestos de cintas transportadoras</option>
                    <option value="pieza">Piezas a medida</option>
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="servicie" class="form-label">Servicio </label>
          <input type="text" class="form-control" id="servicie" name="servicie" required>
      </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6 mb-3">
              <label for="message" class="form-label">Mensaje</label>
              <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
          </div>
            <div class="col-md-6 mb-3">
              <div>
                <label for="inputGroupFile" class="form-label">Adjuntar archivo</label>
                <div class="input-group custom-file-button">
                    <input type="file" class="form-control" id="file" name="file">
                    <label class="input-group-text" for="inputGroupFile">
                        <img src="https://d11.osole.com.ar/lagge/public/images/contacto/file-up.png">
                    </label>
                </div>
            </div>
            </div>
        </div>
        <button type="submit" class="btn btn__azul w-100" onclick="onClick(event)">Enviar</button>
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
