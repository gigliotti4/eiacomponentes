    <nav class="navbar navbar-expand-lg @if (request()->routeIs('index')) bg-transparent @else bg-white shadow @endif">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset(Storage::url($logo->logo_header)) }}" class="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
                @auth('logincliente')
                <div class="ms-auto">


                    <form id="logout-form" action="{{ route('logincliente.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn__transparente " style="">{{ Auth::guard('logincliente')->user()->name }} (Cerrar Sessión)</button>
                    </form>
                </div>
                @else
                <a href="#" class="ms-auto" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <img src="{{ asset('img/user.svg') }}" alt="">
                </a>
                    @endauth
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'nav__menu__inicio' : 'nav__menu' }} {{ request()->routeIs('empresa') ? 'active__header' : '' }}" href="{{ route('empresa') }}">Nosotrosss</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'nav__menu__inicio' : 'nav__menu' }} {{ request()->routeIs('aplicaciones') ? 'active__header' : '' }}" href="">Inyección de plástico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'nav__menu__inicio' : 'nav__menu' }} {{ request()->routeIs('repuestos') ? 'active__header' : '' }}" href="">Mayorista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'nav__menu__inicio' : 'nav__menu' }} {{ request()->routeIs('sectores') ? 'active__header' : '' }}" href="">Como comprar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'nav__menu__inicio' : 'nav__menu' }} {{ request()->routeIs('novedades', 'novedad') ? 'active__header' : '' }}" href="">Novedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'nav__menu__inicio' : 'nav__menu' }} {{ request()->routeIs('contacto.*') ? 'active__header' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    @if ($errors->has('msj'))
                    <div class="alert alert-danger">
                        {{ $errors->first('msj') }}
                    </div>
                  @endif
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Acceso clientes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('logincliente') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="username" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                            <a type="button" href="{{ route('registrarse') }}" class="btn btn__white mb-2 px-5 w-100 mt-4" >Registrarse</a>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

       

    

