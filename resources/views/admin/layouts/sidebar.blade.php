<nav id="sidebar" class="sidebar bg-body-light shadow-right">
  {{-- <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
    <img src="{{asset(Storage::url($logo->logo_header))}}" class="w-75">
  </a> --}}
  <ul class="sidebar-nav nav accordion">
    <a href="{{route('admin.dashboard')}}" class="sidebar-header text-uppercase">
      Administrador
  </a>
    <hr class="mx-3">
    <li class="sidebar-item">
      <a href="" class="nav-link  collapsed" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="colappseCategories">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
          </svg>
        </div>
        <span>Home</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
      <div id="collapseCategories" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.slider.index', ['seccion' => 'inicio']) }}" class="nav-link  ">Slider</a>
        </nav>
      </div>
      <div id="collapseCategories" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.inicio.edit', ['id' => 1]) }}" class="nav-link  ">Contenido</a>
        </nav>
      </div>
    </li>

    <li class="sidebar-item">
      <a href="" class="nav-link  collapsed" data-bs-toggle="collapse" data-bs-target="#collapsEmpresa" aria-expanded="false" aria-controls="colappsEmpresa">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z"/>
          </svg>
        </div>
        <span>Empresa</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
      <div id="collapsEmpresa" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.slider.index', ['seccion' => 'empresa']) }}" class="nav-link  ">Slider</a>
        </nav>
      </div>
      <div id="collapsEmpresa" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.empresa.edit', ['id' => 1]) }}" class="nav-link  ">Contenido</a>
        </nav>
      </div>
    </li>

    <li class="sidebar-item">
      <a href="" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseProducto" aria-expanded="false" aria-controls="colappseProducto">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3L2.95.4ZM7.5 1H3.75L1.5 4h6V1Zm1 0v3h6l-2.25-3H8.5ZM15 5H1v10h14V5Z"/>
          </svg>
        </div>
        <span>Productos</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
       <div id="collapseProducto" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.categorias.index') }}" class="nav-link ">Categorias</a>
        </nav>
      </div>
      <div id="collapseProducto" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.productos.index') }}" class="nav-link ">Productos<</a>
        </nav>
      </div>
      <div id="collapseProducto" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.colores.index') }}" class="nav-link ">Colores</a>
        </nav>
      </div>
   
    </li>

    <li class="sidebar-item">
      <a href="" class="nav-link  collapsed" data-bs-toggle="collapse" data-bs-target="#collapseInyecciones" aria-expanded="false" aria-controls="colappseInyecciones">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
          </svg>
        </div>
        <span>Inyecciones</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
      <div id="collapseInyecciones" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.slider.index', ['seccion' => 'Inyecciones']) }}" class="nav-link  ">Slider</a>
        </nav>
      </div>
      <div id="collapseInyecciones" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.inyecciones.edit', ['id' => 1]) }}" class="nav-link  ">Contenido</a>
        </nav>
      </div>
    </li>


    <li class="sidebar-item">
      <a href="" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseNovedades" aria-expanded="false" aria-controls="colappseNovedades">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3L2.95.4ZM7.5 1H3.75L1.5 4h6V1Zm1 0v3h6l-2.25-3H8.5ZM15 5H1v10h14V5Z"/>
          </svg>
        </div>
        <span>Novedades</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
       <div id="collapseNovedades" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="" class="nav-link ">Categorias Novedades</a>
        </nav>
      </div>
      <div id="collapseNovedades" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="" class="nav-link ">Novedades</a>
        </nav>
      </div>
   
    </li>

    <li class="sidebar-item">
      <a href="" class="nav-link  collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSectores" aria-expanded="false" aria-controls="colappseSectores">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
          </svg>
        </div>
        <span>Sectores</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
      <div id="collapseSectores" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="" class="nav-link  ">Items</a>
        </nav>
      </div>
     
    </li>
    
    <li class="sidebar-item">
      <a href="" class="nav-link ">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z"/>
          </svg>
        </div>
        <span>Repuestos</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="" class="nav-link ">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z"/>
          </svg>
        </div>
        <span>Piezas a medidas</span>
      </a>
    </li>

    <hr class="mx-3">
    <li class="sidebar-item">
      <a href="" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseConfiguracion" aria-expanded="false" aria-controls="collapseConfiguracion">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3L2.95.4ZM7.5 1H3.75L1.5 4h6V1Zm1 0v3h6l-2.25-3H8.5ZM15 5H1v10h14V5Z"/>
          </svg>
        </div>
        <span>Configuración</span>
        <div class="sidenav-collapse-arrow">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </a>
       <div id="collapseConfiguracion" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.contacto.edit', ['id' => 1]) }}" class="nav-link ">Datos de Contacto</a>
        </nav>
      </div>
      <div id="collapseConfiguracion" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.logos.edit', ['id' => 1]) }}" class="nav-link ">Logos</a>
        </nav>
      </div>
      <div id="collapseConfiguracion" class="collapse">
        <nav class="sidenav-menu-nested nav accordion">
          <a href="{{ route('admin.redes.edit', ['id' => 1]) }}" class="nav-link ">Redes Sociales</a>
        </nav>
      </div>

    </li>
    @if(Auth::user()->role == 'Administrador')
    <li class="sidebar-item">
        <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseManageUser" aria-expanded="false" aria-controls="collapseManageUser">
            <div class="nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                </svg>
            </div>
            <span>Usuarios</span>
            <div class="sidenav-collapse-arrow">
                <i class="fa-solid fa-angle-down"></i>
            </div>
        </a>
        <div id="collapseManageUser" class="collapse">
            <nav class="sidenav-menu-nested nav accordion">
                <a href="{{ route('admin.users.index') }}" class="nav-link ">Lista de usuarios</a>
                {{-- <a href="{{ route('admin.users.create') }}" class="nav-link ">Crear usuario</a> --}}
            </nav>
        </div>
    </li>
  @endif

    <li class="sidebar-item">
      <a href="{{ route('admin.newsletter.index') }}" class="nav-link ">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-window" viewBox="0 0 16 16">
            <path d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z"/>
          </svg>
        </div>
        <span>Newsletter</span>
      </a>
    </li> 
    <li class="sidebar-item">
      <a href="{{ route('admin.metadatos.index') }}" class="nav-link ">
        <div class="nav-link-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-window" viewBox="0 0 16 16">
            <path d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z"/>
          </svg>
        </div>
        <span>Metadatos</span>
      </a>
    </li> 
  </ul>
</nav>