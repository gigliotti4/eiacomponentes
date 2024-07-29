<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EIA Componentes')</title>
    <meta name="description" content="@yield('description', 'Fabricante de Componentes eléctricos ')">
    <meta name="keywords" content="@yield('keywords', 'Fichas, Cocodrilos, Automotor, Soldadoras Eléctricas, Componentes, Medición, Exhibidores Clips Acumuladores, Productos de exportación, Cables Electronica, Cables Electricidad, Clips, Fichas Electricidad, Pincha Cable, Fichas Electronica, Ovalos')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <script src="https://www.google.com/recaptcha/enterprise.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
     <link rel="stylesheet" href="{{asset('css/plantilla.css')}}">
     <link rel="stylesheet" href="{{asset('css/page.css')}}">
   
    </head>
  <body>
    <div id="app">
      @include('page.layouts.header')
      @yield('content')
      @include('page.layouts.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      AOS.init();
    </script>
    @stack('scripts')
    <script>
      @if(Session::has('success'))
          toastr.success("{{ Session::get('success') }}");
      @endif
      @if(Session::has('danger'))
          toastr.error("{{ Session::get('danger') }}");
      @endif

      document.addEventListener('DOMContentLoaded', function () {
      @if ($errors->has('msj'))
        var myModal = new bootstrap.Modal(document.getElementById('loginModal'), {});
        myModal.show();
      @endif
  });
    </script>

  
  </body>
</html>

