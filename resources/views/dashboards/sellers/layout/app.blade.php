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
        <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/fontawesome-free/css/all.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/ionicons/css/ionicons.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/typicons.font/typicons.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/flag-icon-css/css/flag-icon.min.css') !!}" rel="stylesheet">
        @yield('css')
        <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">

    </head>
    <body>
        <!-- at-header start-->
        @include('dashboards/sellers/layout/header')
        <!-- at-header end-->
        @yield('content')
        <!-- at-footer start-->
        @include('dashboards/sellers/layout/footer')
        <!-- at-footer end-->

        <!-- at-modals start-->
        @include('dashboards/sellers/partials/success')
        @include('dashboards/sellers/partials/failer')
        <!-- at-modals end-->


        <script type="text/javascript">
            var APP_URL = {!! json_encode(url('/')) !!}
            var ASSET_URL = {!! json_encode(asset('/')) !!}
        </script>
        <script src="{!! asset('assets/lib/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/ionicons/ionicons.js') !!}"></script>
        <script src="{!! asset('assets/js/scripts.js') !!}"></script>
        @yield('js')
        <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>
        <script>
            $(function() {
                'use strict';
                $('.select2').select2({
                    placeholder: 'Choose items',
                    searchInputPlaceholder: 'Search'
                });
            });
        </script>
        @if ($errors->has('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const currentTime = new Date();
                    const options = {
                        weekday: 'short', year: 'numeric', month: 'short', day: 'numeric',
                        hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true
                    };
                    document.getElementById('toast-time').innerText = currentTime.toLocaleString('en-US', options);

                    setTimeout(function(){
                        $('.demo-static-toast').fadeOut('fast');
                    }, 3000);
                });
            </script>
        @endif
        <script>
            $(function(){
                'use strict'
                
            });
        </script>
    </body>
</html>
