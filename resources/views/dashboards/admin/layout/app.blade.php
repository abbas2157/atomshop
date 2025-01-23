<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
        <meta name="description" content="AtomShop - Pay in Steps">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="AtomShop">
        @yield('title')
        <link href="{!! asset('assets/lib/fontawesome-free/css/all.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/ionicons/css/ionicons.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/typicons.font/typicons.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/flag-icon-css/css/flag-icon.min.css') !!}" rel="stylesheet">
        @yield('css')
        <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
       
    </head>
    <body>
        <!-- at-header start-->
        @include('dashboards/admin/layout/header')
        <!-- at-header end-->
        @yield('content')
         <!-- at-footer start-->
         @include('dashboards/admin/layout/footer')
         <!-- at-footer end-->
        <script type="text/javascript">
            var APP_URL = {!! json_encode(url('/')) !!}
            var ASSET_URL = {!! json_encode(asset('/')) !!}
        </script>
        <script src="{!! asset('assets/lib/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/ionicons/ionicons.js') !!}"></script>
        <script src="{!! asset('assets/js/scripts.js') !!}"></script>
        @yield('js')
    </body>
</html>
