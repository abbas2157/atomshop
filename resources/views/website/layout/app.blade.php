<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
    @yield('title')

   <!-- Google Web Fonts -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

   <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="{!! asset('web/lib/animate/animate.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('web/lib/owlcarousel/assets/owl.carousel.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('web/css/style.css') !!}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <!-- Topbar Start -->
    @include('website/layout/topbar')
    <!-- Topbar End -->

    <!-- Navbar Start -->
    @include('website/layout/navbar')
    <!-- Navbar End -->

    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->

    <!-- Footer Start -->
    @include('website/layout/footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    @auth
        <input type="hidden" id="user-type" value="auth">
        <input type="hidden" id="user_id" value="{{ Auth::user()->id ?? '' }}">
    @endauth
    @guest
        <input type="hidden" id="user-type" value="guest">
    @endguest
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
        var ASSET_URL = {!! json_encode(asset('/')) !!}
        var API_URL = {!! json_encode(url('api')) !!}
    </script>
    <script src="{!! asset('web/js/jquery-3.4.1.min.js') !!}"></script>
    <script src="{!! asset('web/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('web/lib/easing/easing.min.js') !!}"></script>
    <script src="{!! asset('web/lib/owlcarousel/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('web/js/main.js') !!}"></script>
    @yield('js')
</body>
</html>
