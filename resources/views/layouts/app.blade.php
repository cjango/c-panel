<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ admin_assets('css/bootstrap.min.css?v=3.3.6') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/font-awesome.min.css?v=4.4.0') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/style.min.css?v=4.1.0') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/plugins/sweetalert/sweetalert.css') }}" />
    @yield('css')
    @yield('js')
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInDown">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ admin_assets('js/jquery.min.js?v=2.1.4') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/bootstrap.min.js?v=3.3.6') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/content.min.js?v=1.0.0') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/plugins/pace/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/plugins/layer/layer.min.js') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/common.js') }}"></script>
    @stack('script')
</body>

</html>
