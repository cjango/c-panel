<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ config('app.name', '') }} 系统登录</title>
    <link rel="stylesheet" href="{{ asset('assets/cpanel/js/plugins/layui/css/layui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/cpanel/css/animate.min.css') }}" />
    <style type="text/css">
        body {
            background-image: url({{ asset('assets/cpanel/img/bg'.rand(1,3).'.jpg') }});
        }
    </style>
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>
</head>
<body>
    <div class="mask"></div>
    <div class="main">
        <h1><span style="font-size: 84px;">{{ config('app.name', '') }} </span><span style="font-size:20px;">system</span></h1>
        <div class="enter">
            <h2 class="animated">Click&nbsp;&nbsp;Here&nbsp;&nbsp;To&nbsp;&nbsp;Login</h2>
            <form action="{{ route('CPanel.login') }}" class="layui-form animated bounceInLeft" method="post">
                <div class="layui-form-item">
                    <label class="login-icon"> <i class="layui-icon">&#xe612;</i> </label>
                    <input type="text" name="username" lay-verify="username" autocomplete="off" placeholder="请输入登录名" class="layui-input" value="" />
                </div>
                <div class="layui-form-item">
                    <label class="login-icon"> <i class="layui-icon">&#xe642;</i> </label>
                    <input type="password" name="password" lay-verify="password" autocomplete="off" placeholder="请输入密码" class="layui-input" />
                </div>
                <div class="layui-form-item">
                    <label class="login-icon"> <i class="layui-icon">&#xe642;</i> </label>
                    <input type="text" name="verify" lay-verify="verify" autocomplete="off" placeholder="请输入验证码" class="layui-input verify" />
                    <div class="code" style="background-image:url({{ captcha_src() }});"></div>
                </div>
                <div class="layui-form-item">
                    <div class="pull-left login-remember">
                        <label>记住帐号？</label>
                        <input type="checkbox" name="remember" value="true" checked lay-skin="switch" title="保持登录">
                    </div>
                    <div class="pull-right">
                        @csrf
                        <button class="layui-btn layui-btn-primary" lay-submit lay-filter="login"> <i class="layui-icon">&#xe650;</i> 登录 </button>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/cpanel/js/plugins/layui/layui.js') }}"></script>
    <script>
        layui.use(['form'], function() {
            var $ = layui.jquery, form = layui.form();
            $("h2").on('click', function(){
                $(this).hide();
                $('.layui-form').show();
            });
            $('.code').on('click', function() {
                $(this).attr('style', 'background-image:url({{ captcha_src() }}&_='+ Math.random() +');');
            });
            layer.config({
                time: 1000
            });
            form.verify({
                username: function (value) {
                    if (value.length < 4 || value.length > 20) {
                        return "账号应在4-20位之间"
                    }
                    var reg = /^[a-zA-Z0-9]*$/;
                    if (!reg.test(value)) {
                        return "账号只能为英文或数字";
                    }
                },
                password: [/^[\S]{4,20}$/, '密码应在4-20位之间'],
                verify: [/^[\S]{5}$/, '验证码长度有误']
            });
            form.on('submit(login)', function(data) {
                layer.load(2);
                $('form').removeClass('bounceInLeft');
                $.post(data.form.action, data.field, function(res) {
                    layer.closeAll('loading');
                    if (res.code == 1) {
                        layer.msg(res.msg, {icon: 1, time: 1000}, function() {
                            location.href = res.url;
                        });
                    } else {
                        $('form').addClass('shake');
                        layer.msg(res.msg, {icon: 5}, function() {
                            $('form').removeClass('shake');
                        });
                        $('.code').click();
                    }
                });
                return false;
            });
        });
</script>
</body>
</html>
