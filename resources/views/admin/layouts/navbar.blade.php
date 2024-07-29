<nav class="navbar navbar-expand-lg bg-body-light topbar mb-4">
    <div class="container-fluid px-2">
      <div class="d-flex align-items-center gap-lg-2">
        <button class="button-toggle-menu" id="sidebarToggle">
          <i class="fa-solid fa-bars"></i>
        </button>
        {{--
        <div class="app-search d-none d-lg-block">
          <form action="">
            <div class="input-group">
              <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
              <span class="position-absolute search-icon my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></span> 
              <button class="btn search-btn" type="submit">Search</button>
            </div>
          </form>
        </div>
        --}}
      </div>
      <div class="">
        <ul class="navbar-nav ms-automb-lg-0">
        
          <li class="nav-item dropdown">
            <a class="nav-user nav-link dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{-- <span class="account-user-avatar">
                @if (!is_null(Auth::user()->image))
                  <img src="{{asset(Auth::user()->image)}}" alt="Profile Pic" class="user-avatar rounded-circle"> 
                @endif
              </span> --}}
              <span class="d-none d-lg-flex flex-column gap-1 d-none">
              <h5 class="my-0 text-grey-600 small">{{Auth::user()->name}}</h5>
                <h6 class="my-0 fw-normal small">{{Auth::user()->role}}</h6>                    
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow position-absolute">
              <li>
                <a class="dropdown-item" href="">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                  </svg> Mis datos
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{route('logout')}}" onclick=>
                  @csrf
                  <a href="{{route('logout')}}" onclick="event.preventDefault();
                  this.closest('form').submit();" class="dropdown-item text-danger" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                      <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg> Cerrar sesión
                  </a>
                </form>
              </li>
              
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>
  
  