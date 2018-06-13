<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/bootstrap.min.css?v=3.3.6') }}" />
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/font-awesome.min.css?v=4.4.0') }}" />
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/style.min.css?v=4.1.0') }}" />
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/plugins/sweetalert/sweetalert.css') }}" />
    @yield('css')
    @yield('js')
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInDown">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/jquery.min.js?v=2.1.4') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/bootstrap.min.js?v=3.3.6') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/content.min.js?v=1.0.0') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/plugins/pace/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/plugins/layer/layer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/common.js') }}"></script>
    @stack('script')
</body>

</html>
