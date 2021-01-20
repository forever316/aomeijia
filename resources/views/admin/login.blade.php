<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="0">
    <title>致富管理后台 - 登录</title>

    <link href="/assets/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/assets/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/assets/admin/css/animate.min.css" rel="stylesheet">
    <link href="/assets/admin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <!--[if lt IE 8] <link href="/assets/admin/js/plugins/layer/new/skin/layer.css" rel="stylesheet">>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">WL</h1>

            </div>
            <h3>欢迎使用&nbsp;-&nbsp;致富管理后台</h3>

            <form class="m-t" action="/login" method="post" target="_self">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="用户名" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="密码" required>
                </div>
                <div class="form-group" style="overflow:hidden;">
                    <div style="width:170px;float: left;">
                        <input type="text" class="form-control" id="captcha" name="captcha" value="{{ old('captcha') }}" placeholder="验证码" required>
                    </div>
                    <span id="captcha_span" style="float: right;cursor:pointer;">
                        <img src="/getCaptcha2" id="getcode_num" title="看不清，点击换一张" align="absmiddle" />
                    </span>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
    </div>
    </div>
    <script src="/assets/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/assets/admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/assets/admin/js/plugins/layer/new/layer.js"></script>
    <script src="/assets/common/jquery.cookie.js"></script>
    <script src="/assets/common/common.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript">
        $(function(){
            <?php
                if(isset($data)):
             ?>
            var data = jQuery.parseJSON('<?php echo $data ?>');
            $.kh.fromTips(data,4);
            <?php endif;?>
            //获取验证码
           //$.kh.getCaptcha('120','34','captcha_span');
            $("#getcode_num").click(function(){
                $(this).attr("src",'/getCaptcha2?' + Math.random());
            });
        });
    </script>
</body>

</html>