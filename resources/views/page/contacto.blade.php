@extends('layouts.app')
@section('title', 'Contacto')
@section('content')
{{-- <div class="bg__breadcrumb">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Contacto</li>

            </ol>
            <span class="breadcrumb-titulo">Contacto</span>
          </nav>
    </div>
</div> --}}


{!!$contacto->mapa!!}

<div class="container my-5">
  <div class="row">
    <div class="col-md-4">
      <div class="info-contact">
        <h3 class="titulo__secciones">Contacto</h3>
       
        <div class="item-contact mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M16.6663 8.33332C16.6663 13.3333 9.99967 18.3333 9.99967 18.3333C9.99967 18.3333 3.33301 13.3333 3.33301 8.33332C3.33301 6.56521 4.03539 4.86952 5.28563 3.61928C6.53587 2.36904 8.23156 1.66666 9.99967 1.66666C11.7678 1.66666 13.4635 2.36904 14.7137 3.61928C15.964 4.86952 16.6663 6.56521 16.6663 8.33332Z" stroke="#FE2324" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 10.8333C11.3807 10.8333 12.5 9.71406 12.5 8.33334C12.5 6.95263 11.3807 5.83334 10 5.83334C8.61929 5.83334 7.5 6.95263 7.5 8.33334C7.5 9.71406 8.61929 10.8333 10 10.8333Z" stroke="#FE2324" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            <a href="{{$contacto->enlace}}" target="_blank" class="datos__contacto">{{$contacto->direccion}}</a>
        </div>
    
        <div class="item-contact my-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <g clip-path="url(#clip0_1215_7450)">
                  <path d="M18.3332 14.1V16.6C18.3341 16.8321 18.2866 17.0618 18.1936 17.2745C18.1006 17.4871 17.9643 17.678 17.7933 17.8349C17.6222 17.9918 17.4203 18.1112 17.2005 18.1856C16.9806 18.26 16.7477 18.2876 16.5165 18.2667C13.9522 17.988 11.489 17.1118 9.32486 15.7083C7.31139 14.4289 5.60431 12.7218 4.32486 10.7083C2.91651 8.53435 2.04007 6.05917 1.76653 3.48334C1.7457 3.2529 1.77309 3.02064 1.84695 2.80136C1.9208 2.58208 2.03951 2.38058 2.1955 2.20969C2.3515 2.0388 2.54137 1.90227 2.75302 1.80878C2.96468 1.71529 3.19348 1.66689 3.42486 1.66668H5.92486C6.32928 1.6627 6.72136 1.80591 7.028 2.06962C7.33464 2.33333 7.53493 2.69955 7.59153 3.10001C7.69705 3.90006 7.89274 4.68562 8.17486 5.44168C8.28698 5.73995 8.31125 6.0641 8.24478 6.37574C8.17832 6.68738 8.02392 6.97344 7.79986 7.20001L6.74153 8.25834C7.92783 10.3446 9.65524 12.072 11.7415 13.2583L12.7999 12.2C13.0264 11.976 13.3125 11.8216 13.6241 11.7551C13.9358 11.6886 14.2599 11.7129 14.5582 11.825C15.3143 12.1071 16.0998 12.3028 16.8999 12.4083C17.3047 12.4655 17.6744 12.6693 17.9386 12.9813C18.2029 13.2932 18.3433 13.6913 18.3332 14.1Z" stroke="#FE2324" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                  <clipPath id="clip0_1215_7450">
                    <rect width="20" height="20" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
            <a href="tel:{!!$contacto->telefono!!}" class="datos__contacto">{{$contacto->telefono}}</a>
        </div>
    
        <div class="item-contact mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5823 11.985C14.3328 11.8608 13.1095 11.2625 12.8817 11.1792C12.6539 11.0967 12.4881 11.0558 12.3215 11.3042C12.1557 11.5508 11.6793 12.1092 11.5344 12.2742C11.3887 12.44 11.2438 12.46 10.9952 12.3367C10.7465 12.2117 9.94429 11.9508 8.99391 11.1075C8.25453 10.4509 7.75464 9.64002 7.60978 9.39169C7.46492 9.14419 7.59387 9.01002 7.71863 8.88669C7.83084 8.77585 7.96732 8.59752 8.09209 8.45335C8.21685 8.30835 8.25788 8.20502 8.34078 8.03919C8.42451 7.87419 8.38265 7.73002 8.31985 7.60585C8.25788 7.48169 7.7605 6.26252 7.55284 5.76669C7.35104 5.28419 7.14589 5.35003 6.99349 5.34169C6.8478 5.33503 6.682 5.33336 6.51621 5.33336C6.35041 5.33336 6.08079 5.39503 5.85303 5.64336C5.62444 5.89086 4.98219 6.49002 4.98219 7.70919C4.98219 8.92752 5.87313 10.105 5.99789 10.2709C6.12266 10.4359 7.75213 12.9375 10.2482 14.01C10.8428 14.265 11.3058 14.4175 11.6667 14.5308C12.2629 14.72 12.8055 14.6933 13.2342 14.6292C13.7115 14.5583 14.7063 14.03 14.9139 13.4517C15.1208 12.8733 15.1207 12.3775 15.0588 12.2742C14.9968 12.1708 14.831 12.1092 14.5815 11.985H14.5823ZM10.0423 18.1542H10.0389C8.55634 18.1544 7.10099 17.7578 5.8254 17.0058L5.52396 16.8275L2.39062 17.6458L3.22712 14.6058L3.03035 14.2942C2.20149 12.9811 1.76286 11.4615 1.76512 9.91085C1.76679 5.36919 5.47958 1.6742 10.0456 1.6742C12.2562 1.6742 14.3345 2.53253 15.897 4.08919C16.6676 4.85301 17.2785 5.76133 17.6941 6.7616C18.1098 7.76188 18.322 8.83425 18.3186 9.91668C18.3169 14.4583 14.6041 18.1542 10.0423 18.1542ZM17.086 2.9067C16.1634 1.98247 15.0657 1.24965 13.8564 0.7507C12.6472 0.251754 11.3505 -0.00339687 10.0414 3.41479e-05C4.55347 3.41479e-05 0.085409 4.44586 0.0837344 9.91002C0.0811914 11.649 0.539563 13.3578 1.4126 14.8642L0 20L5.27861 18.6217C6.73884 19.4134 8.37519 19.8283 10.0381 19.8283H10.0423C15.5302 19.8283 19.9983 15.3825 20 9.91752C20.004 8.61525 19.7485 7.32511 19.2484 6.12172C18.7482 4.91833 18.0132 3.82559 17.086 2.9067Z" fill="#7CB420"/>
              </svg>
            <a href="https://api.whatsapp.com/send?phone={{$contacto->whatsapp}}" target="_blank" class="datos__contacto">{{$contacto->whatsapp}}</a>
        </div>

        <div class="item-contact">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M16.667 3.33333H3.33366C2.41318 3.33333 1.66699 4.07952 1.66699 4.99999V15C1.66699 15.9205 2.41318 16.6667 3.33366 16.6667H16.667C17.5875 16.6667 18.3337 15.9205 18.3337 15V4.99999C18.3337 4.07952 17.5875 3.33333 16.667 3.33333Z" stroke="#FE2324" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.3337 5.83333L10.8587 10.5833C10.6014 10.7445 10.3039 10.83 10.0003 10.83C9.69673 10.83 9.39927 10.7445 9.14199 10.5833L1.66699 5.83333" stroke="#FE2324" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            <a href="mailto:{{$contacto->correo}}" target="_blank" class="datos__contacto">{{$contacto->correo}}</a>
        </div>
    </div>
    </div>   
    <div class="col-md-8">
      <form id="contact-form" method="POST">
        @csrf
        <input type='hidden' name='g-recaptcha-response' id='g-recaptcha-response'>
        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nombre*</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="surname" class="form-label">Apellido*</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electrónico *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Teléfono *</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

        </div>
        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="message" class="form-label">Mensaje</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <div class="col-md-6 ">
                <button type="submit" class="btn btn__rojo mt-5 ms-5" >Enviar consulta</button>
            </div>
        </div>
    </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ env("RECAPTCHA_SITE_KEY") }}', { action: 'submit' }).then(function (token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });

    document.getElementById('contact-form').addEventListener('submit', function (event) {
        event.preventDefault();

        grecaptcha.execute('{{ env("RECAPTCHA_SITE_KEY") }}', { action: 'submit' }).then(function (token) {
            document.getElementById('g-recaptcha-response').value = token;

            let form = event.target;
            let formData = new FormData(form);

            $.ajax({
                url: '{{ route("contacto.send") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                success: function (data) {
                    if (data.message) {
                        toastr.success(data.message); // Display success message with Toastr
                        form.reset();
                    } else {
                        toastr.error(data.error); // Display error message with Toastr
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                    toastr.error('Error al enviar el mensaje.'); // Display generic error message with Toastr
                }
            });
        });
    });
});


</script>

@endpush

