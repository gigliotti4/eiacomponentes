
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- General CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-xl-5 m-auto">
                <div class="d-flex login-brand mb-4">
                    <img src="{{asset(@$logoSetting->logo)}}" alt="" width="180" class="mx-auto ">
                </div>
                <div class="card border-0 shadow">
                    <div class="card-body mt-6 py-4 px-4">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <input type="hidden" name="admin" value="admin">
                            <div class="mb-3">
                              <!--<label for="exampleInputEmail1" class="form-label">Email address</label> -->
                              <input id="username" class="form-control my-4 py-2" type="username" name="username" placeholder="username" required autofocus value="{{old('username')}}">
                             
                  
                            </div>
                            <div class="mb-3">
                              <!--<label for="exampleInputEmail1" class="form-label">Email address</label> -->
                              <input id="password" class="form-control my-4 py-2" type="password" name="password" placeholder="Contraseña" required>
                             
                            </div>
                            <div class="mb-3 d-md-flex position-relative">
                                <div class="w-50 text-start form-check">
                                  
                                </div>
                                
                                
                                {{-- @if (Route::has('password.request'))
                                <div class="w-50 text-md-end">
                                    <a href="{{ route('password.request') }}" class="">¿Olvidaste tu contraseña?</a> 
                                </div>
                                   
                                @endif --}}
                              
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-primary btn-dark w-100"> Login </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- General JS Scripts -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{asset('backend/assets/modules/code.jquery.com_jquery-3.7.0.min')}}"></script>
<script>
    const sidebarToggle = document.querySelector('#sidebarToggle'); 
    const sidebar = document.getElementById('sidebar');
    sidebarToggle.addEventListener('click', ()=>{
    sidebar.classList.toggle('hide'); 
    })
</script>
</body>
</html>
