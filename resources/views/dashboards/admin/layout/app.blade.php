<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="AtomShop - Pay in Steps">
        <meta name="author" content="AtomShop">
        @yield('title')
        <link href="{!! asset('assets/lib/fontawesome-free/css/all.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/ionicons/css/ionicons.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/typicons.font/typicons.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/flag-icon-css/css/flag-icon.min.css') !!}" rel="stylesheet">
        <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
        @yield('css')
    </head>
    <body>
        <!-- at-header start-->
        @include('dashboards/admin/layout/header')
        <!-- at-header end-->
        <div class="az-content az-content-dashboard">
            <div class="container">
                <div class="az-content-body">
                    @yield('content')
                </div>
            </div>
        </div>
         <!-- at-footer start-->
         @include('dashboards/admin/layout/footer')
         <!-- at-footer end-->
        <script src="{!! asset('assets/lib/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/ionicons/ionicons.js') !!}"></script>

        <script src="{!! asset('assets/js/scripts.js') !!}"></script>
        @yield('css')
    </body>
</html>
