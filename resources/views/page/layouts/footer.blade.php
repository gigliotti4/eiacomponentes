<footer>
    <div class="container">
        <div class="row">
            <!-- Logo and Secciones -->
            <div class="col-12 col-md-2">
                <img src="{{ asset(Storage::url($logo->logo_footer)) }}" class="">
            </div>
            
            <!-- Secciones -->
            <div class="col-12 col-md-2 ">
                <span class="footer__secciones mb-5">    
                    secciones
                </span>
                <div class="d-flex flex-column">
                    <a href="" class="nav__footer">Productos</a>
                    <a href="" class="nav__footer">Inyección de plástico</a>
                    <a href="" class="nav__footer">Mayorista</a>
                </div>
            </div>
            
            <!-- Como comprar -->
            <div class="col-12 col-md-2 mt-4">
                <div class="d-flex flex-column">
                    <a href="" class="nav__footer">Como comprar</a>
                    <a href="" class="nav__footer">Quienes somos</a>
                    <a href="" class="nav__footer">Contacto</a>
                </div>
            </div>
            
    <!-- Suscribite al Newsletter -->
<div class="col-12 col-md-3 mb-5">
    <span class="footer__secciones">
        Suscribite al Newsletter
    </span>
    <form class="input-with-arrow" action="javascript:void(0);">
        <input type="email" class="form-control bg-transparent text-white" placeholder="Ingresa tu email" name="search" required>
        <button type="submit">
          
        </button>
    </form>
</div>

            <!-- Contacto -->
            <div class="col-12 col-md-3 ">
                <span class="footer__secciones  ">    
                    Contacto
                </span>
                <div class="contact-info">
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.6666 8.33329C16.6666 13.3333 9.99992 18.3333 9.99992 18.3333C9.99992 18.3333 3.33325 13.3333 3.33325 8.33329C3.33325 6.56518 4.03563 4.86949 5.28587 3.61925C6.53612 2.36901 8.23181 1.66663 9.99992 1.66663C11.768 1.66663 13.4637 2.36901 14.714 3.61925C15.9642 4.86949 16.6666 6.56518 16.6666 8.33329Z" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 10.8334C11.3807 10.8334 12.5 9.71409 12.5 8.33337C12.5 6.95266 11.3807 5.83337 10 5.83337C8.61929 5.83337 7.5 6.95266 7.5 8.33337C7.5 9.71409 8.61929 10.8334 10 10.8334Z" stroke="#7CB420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <a href="{{$contacto->enlace}}" target="_blank" class="nav__footer">{{$contacto->direccion}}</a>
                    </div>
                
                    <div class="contact-item">
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
                        <a href="tel:{!!$contacto->telefono!!}" class="nav__footer">{{$contacto->telefono}}</a>
                    </div>
                
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5823 11.985C14.3328 11.8608 13.1095 11.2625 12.8817 11.1792C12.6539 11.0967 12.4881 11.0558 12.3215 11.3042C12.1557 11.5508 11.6793 12.1092 11.5344 12.2742C11.3887 12.44 11.2438 12.46 10.9952 12.3367C10.7465 12.2117 9.94429 11.9508 8.99391 11.1075C8.25453 10.4509 7.75464 9.64002 7.60978 9.39169C7.46492 9.14419 7.6148 9.01586 7.7398 8.89169C7.85173 8.77919 8.00053 8.58419 8.12129 8.42836C8.24117 8.27336 8.29145 8.16086 8.37357 8.00836C8.4557 7.85586 8.41595 7.74169 8.3427 7.61669C8.26945 7.49002 7.80726 6.31753 7.63171 5.89919C7.45757 5.48002 7.28338 5.53752 7.12088 5.52919C6.96748 5.52194 6.79993 5.52192 6.6327 5.52192C6.46545 5.52192 6.23198 5.57419 6.02948 5.78753C5.82698 6.00192 5.29902 6.52586 5.29902 7.58336C5.29902 8.64002 6.04155 9.63169 6.1353 9.76169C6.22898 9.89086 7.54762 11.8559 9.63664 13.055C11.0465 13.895 11.4899 14.0417 11.9332 14.1875C12.3765 14.3342 12.8852 14.1584 13.1065 13.8417C13.3278 13.525 13.7852 12.715 13.9332 12.4425C14.0812 12.1692 14.2287 12.2234 14.4804 12.3408C14.7312 12.4575 15.6407 12.8608 15.8982 12.9733C16.1557 13.085 16.3737 13.1483 16.4892 13.1742C16.6047 13.2 16.827 13.2584 17.0455 13.2584C17.264 13.2584 17.7546 13.1025 17.9761 12.7275C18.1976 12.3525 18.1976 11.9967 18.1517 11.9225C18.1067 11.8475 16.8312 11.1108 16.532 10.935C16.2328 10.7592 15.8327 10.9192 15.5832 11.0433Z" fill="#7CB420"/>
                        </svg>
                        <a href="mailto:{!!$contacto->correo!!}" class="nav__footer">{{$contacto->correo}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')

<script>
    $(document).ready(function() {
        $('form.input-with-arrow').on('submit', function(e) {
            e.preventDefault();
            
            var email = $(this).find('input[name="search"]').val();
            var _token = '{{ csrf_token() }}';

            $.ajax({
                url: "{{ route('newsletter.send') }}",
                method: "POST",
                data: { email: email, _token: _token },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Suscripción exitosa!',
                        text: response.success,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('form.input-with-arrow')[0].reset();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errors.email[0],
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });
    });
</script>


@endpush

