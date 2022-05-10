<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Home | E-Shopper</title>
  <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

  <link rel="shortcut icon" href="images/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png')}}">
  @stack('style')

</head>
<!--/head-->

<body>
  @include('header')
  <!--/header-->

  @section('slider')
  @show



  <section style="margin-top: 5rem;">
    <div class="container">
      <div class="row">
        @section('sidebar')
        @show


        @yield('content')
        {{-- <div class="col-sm-9 padding-right">
        </div> --}}
      </div>
    </div>
  </section>

  @include('footer')
  <!--/Footer-->



  <script src="{{ asset('frontend/js/jquery.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
  <script src="{{ asset('frontend/js/price-range.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
  <script src="{{ asset('frontend/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <link rel="stylesheet" href="sweetalert2.min.css"> --}}
  @include('sweetalert::alert')

  @stack('script')
</body>

</html>
