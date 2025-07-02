<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>{{ config('app.name') . ' | ' . $module }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('logo-user.png') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/responsive.css') }}">

    <!-- Color Scheme -->
    <link rel="stylesheet" href="{{ asset('assets-landing/css/colors/color.css') }}" title="color" /><!-- Color -->
    <link rel="alternate stylesheet" href="{{ asset('assets-landing/css/colors/color2.css') }}" title="color2" />
    <!-- Color2 -->
    <link rel="alternate stylesheet" href="{{ asset('assets-landing/css/colors/color3.css') }}" title="color3" />
    <!-- Color3 -->
    <link rel="alternate stylesheet" href="{{ asset('assets-landing/css/colors/color4.css') }}" title="color4" />
    <!-- Color4 -->

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body itemscope>
    <div class="preloader">
        <div class="loader-inner ball-scale-multiple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div><!-- Preloader -->
    <main>
        @if (!request()->routeIs('monitoring'))
            @include('user.layouts.header')
        @endif

        @yield('content')

        @if (!request()->routeIs('monitoring'))
            @include('user.layouts.footer')
        @endif

    </main><!-- Main Wrapper -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAuMXqxko3XzV4LngCe3QVhsy19ICKojM"></script>
    <script src="{{ asset('assets-landing/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/google-map-int.js') }}"></script>
    <script src="{{ asset('assets-landing/js/custom-scripts.js') }}"></script>
    <script src="{{ asset('assets-landing/namaz-timings/namaz.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>

</html>
