<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wedding Decoration</title>
   
    @stack('style')

  {{--   <link rel="stylesheet"
        href="{{ asset('dist/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" /> --}}
        

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />


    <link rel="stylesheet"
    href="{{ asset('dist/css/components.css') }}">
    <link rel="stylesheet"
    href="{{ asset('dist/css/admin.css') }}">


    <link rel="stylesheet" href="{{ asset('dist/css/animate.css') }}">
       
    <link rel="stylesheet" href="{{ asset('dist/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/nice-select.css') }}">


      <!-- Start GA -->
      <script async
      src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
          dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-94034622-3');
  </script>
  <!-- END GA -->
  </head>
  <body>
   
    <div>
      <div class="main-wrapper">
        @include('cust-components.header')

        
    @include('cust-components.sidebar')

    @yield('content')
    
        
      </div>
    </div>
  
    @stack('modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  
  <script src="{{ asset('dist/library/popper.js/dist/umd/popper.js') }}"></script>
  <script src="{{ asset('dist/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
  <script src="{{ asset('dist/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dist/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('dist/library/moment/min/moment.min.js') }}"></script>

  <script src="{{ asset('dist/js/stisla.js') }}"></script>
  <script src="{{ asset('dist/js/scripts.js') }}"></script>
  <script src="{{ asset('dist/js/custom.js') }}"></script>

  @stack('scripts')
  </body>
</html>