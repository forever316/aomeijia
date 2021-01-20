<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>致富管理后台 - 登录</title>

    <link href="/assets/admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/assets/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/assets/admin/css/animate.min.css" rel="stylesheet">
    <link href="/assets/admin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <link href="/assets/admin/js/plugins/layer/new/skin/layer.css" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="lock-word animated fadeInDown">
    </div>
    <div class="middle-box text-center lockscreen animated fadeInDown" style="width: 212px;">
        <div>
            <div class="m-b-md">
                <img alt="image" class="img-circle circle-border" src="/assets/admin/img/wl_LOGO.png">
            </div>
            <h3>{{$name}}</h3>
            <p>您需要再次输入密码</p>
            <form class="m-t" role="form" method="post" action="/login2" target="_self">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="请再次输入密码" value="{{ old('password') }}" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width">登录</button>
            </form>
        </div>
    </div>

<script src="/assets/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/assets/admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/assets/admin/js/plugins/layer/new/layer.js"></script>
<script src="/assets/common/jquery.cookie.js"></script>
<script src="/assets/common/common.js"></script>
<script type="text/javascript">
    $(function(){
        <?php
            if(isset($data)):
         ?>
        var data = jQuery.parseJSON('<?php echo $data ?>');
        $.kh.fromTips(data,4);
        <?php endif;?>
    });
</script>
</body>
</html>