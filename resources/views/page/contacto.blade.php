@extends('layouts.app')
@section('title', 'Contacto')
@section('content')
<div class="bg__breadcrumb">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
              <li class="breadcrumb-item active" >Contacto</li>

            </ol>
            <span class="breadcrumb-titulo">Contacto</span>
          </nav>
    </div>
</div>


{!!$contacto->mapa!!}

<div class="container my-5">
  <div class="row">
    <div class="col-md-6">
      <div class="info-contact">
        <h3 class="contenido__titulo">Contacto</h3>
        <span>Complete el formulario para que podamos contactarnos con usted a la brevedad</span>
        <div class="item-contact mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M16.6666 8.33329C16.6666 13.3333 9.99992 18.3333 9.99992 18.3333C9.99992 18.3333 3.33325 13.3333 3.33325 8.33329C3.33325 6.56518 4.03563 4.86949 5.28587 3.61925C6.53612 2.36901 8.23181 1.66663 9.99992 1.66663C11.768 1.66663 13.4637 2.36901 14.714 3.61925C15.9642 4.86949 16.6666 6.56518 16.6666 8.33329Z" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 10.8334C11.3807 10.8334 12.5 9.71409 12.5 8.33337C12.5 6.95266 11.3807 5.83337 10 5.83337C8.61929 5.83337 7.5 6.95266 7.5 8.33337C7.5 9.71409 8.61929 10.8334 10 10.8334Z" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <a href="{{$contacto->enlace}}" target="_blank" class="datos__contacto">{{$contacto->direccion}}</a>
        </div>
    
        <div class="item-contact my-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <g clip-path="url(#clip0_2421_570)">
                    <path d="M18.3334 14.1V16.6C18.3344 16.8321 18.2868 17.0618 18.1939 17.2745C18.1009 17.4871 17.9645 17.678 17.7935 17.8349C17.6225 17.9918 17.4206 18.1113 17.2007 18.1856C16.9809 18.26 16.7479 18.2876 16.5168 18.2667C13.9525 17.9881 11.4893 17.1118 9.32511 15.7084C7.31163 14.4289 5.60455 12.7219 4.32511 10.7084C2.91676 8.53438 2.04031 6.0592 1.76677 3.48337C1.74595 3.25293 1.77334 3.02067 1.84719 2.80139C1.92105 2.58211 2.03975 2.38061 2.19575 2.20972C2.35174 2.03883 2.54161 1.9023 2.75327 1.80881C2.96492 1.71532 3.19372 1.66692 3.42511 1.66671H5.92511C6.32953 1.66273 6.7216 1.80594 7.02824 2.06965C7.33488 2.33336 7.53517 2.69958 7.59177 3.10004C7.69729 3.9001 7.89298 4.68565 8.17511 5.44171C8.28723 5.73998 8.31149 6.06414 8.24503 6.37577C8.17857 6.68741 8.02416 6.97347 7.80011 7.20004L6.74177 8.25837C7.92807 10.3447 9.65549 12.0721 11.7418 13.2584L12.8001 12.2C13.0267 11.976 13.3127 11.8216 13.6244 11.7551C13.936 11.6887 14.2602 11.7129 14.5584 11.825C15.3145 12.1072 16.1001 12.3029 16.9001 12.4084C17.3049 12.4655 17.6746 12.6694 17.9389 12.9813C18.2032 13.2932 18.3436 13.6914 18.3334 14.1Z" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                    <clipPath id="clip0_2421_570">
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
                <path d="M16.6665 3.33325H3.33317C2.4127 3.33325 1.6665 4.07944 1.6665 4.99992V14.9999C1.6665 15.9204 2.4127 16.6666 3.33317 16.6666H16.6665C17.587 16.6666 18.3332 15.9204 18.3332 14.9999V4.99992C18.3332 4.07944 17.587 3.33325 16.6665 3.33325Z" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.3332 5.83325L10.8582 10.5833C10.6009 10.7444 10.3034 10.8299 9.99984 10.8299C9.69624 10.8299 9.39878 10.7444 9.1415 10.5833L1.6665 5.83325" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            <a href="mailto:{{$contacto->correo}}" target="_blank" class="datos__contacto">{{$contacto->correo}}</a>
        </div>
    </div>
    </div>   
    <div class="col-md-6">
      <form id="contact-form" method="POST">
        @csrf
        <input type='hidden' name='g-recaptcha-response' id='g-recaptcha-response'>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre*</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico *</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono *</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn__azul w-100" >Enviar</button>
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

